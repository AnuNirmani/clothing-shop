<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SizeController extends Controller
{
    /**
     * Display a listing of sizes
     */
    public function index()
    {
        $sizes = Size::latest()->paginate(10);
        return view('sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new size
     */
    public function create()
    {
        return view('sizes.create');
    }

    /**
     * Store a newly created size in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sizes,name',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle photo upload if present
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('sizes', 'public');
        }

        Size::createSize($validated);

        return redirect()->route('sizes.index')->with('success', 'Size created successfully!');
    }

    /**
     * Display the specified size
     */
    public function show($id)
    {
        $size = Size::getSizeById($id);
        return view('sizes.show', compact('size'));
    }

    /**
     * Show the form for editing the specified size
     */
    public function edit($id)
    {
        $size = Size::getSizeById($id);
        return view('sizes.edit', compact('size'));
    }

    /**
     * Update the specified size in database
     */
    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sizes,name,' . $size->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $data = ['name' => $request->name];

            // Handle photo upload if present
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($size->photo) {
                    Storage::disk('public')->delete($size->photo);
                }
                $data['photo'] = $request->file('photo')->store('sizes', 'public');
            }

            $size->update($data);

            return redirect()->route('sizes.index')
                ->with('success', 'Size updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('sizes.index')
                ->withErrors(['name' => 'Failed to update size.'])
                ->with('edit_error_id', $size->id)
                ->withInput();
        }
    }

    /**
     * Remove the specified size from database
     */
    public function destroy($id)
    {
        $size = Size::getSizeById($id);
        
        // Delete photo if exists
        if ($size->photo) {
            Storage::disk('public')->delete($size->photo);
        }
        
        Size::deleteSize($id);
        return redirect()->route('sizes.index')->with('success', 'Size deleted successfully!');
    }
}
