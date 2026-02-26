<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of types
     */
    public function index()
    {
        $types = Type::with('category')->latest()->paginate(10);
        $categories = Category::orderBy('name')->get();

        return view('types.index', compact('types', 'categories'));
    }

    /**
     * Show the form for creating a new type
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('types.create', compact('categories'));
    }

    /**
     * Store a newly created type in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        Type::create($validated);

        return redirect()->route('types.index')->with('success', 'Type created successfully.');
    }

    /**
     * Display the specified type
     */
    public function show($id)
    {
        $type = Type::getTypeById($id);
        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified type
     */
    public function edit($id)
    {
        $type = Type::getTypeById($id);
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified type in database
     */
    public function update(Request $request, Type $type)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:types,name,' . $type->id,
    ]);

    try {
        $type->update([
            'name' => $request->name,
        ]);

        return redirect()->route('types.index')
            ->with('success', 'Type updated successfully!');
    } catch (\Exception $e) {
        return redirect()->route('types.index')
            ->withErrors(['name' => 'Failed to update type.'])
            ->with('edit_error_id', $type->id)
            ->withInput();
    }
}

    /**
     * Remove the specified type from database
     */
    public function destroy($id)
    {
        Type::deleteType($id);
        return redirect()->route('types.index')->with('success', 'Type deleted successfully!');
    }
}
