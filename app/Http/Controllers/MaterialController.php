<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of materials
     */
    public function index()
    {
        $materials = Material::latest()->paginate(10);
        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new material
     */
    public function create()
    {
        return view('materials.create');
    }

    /**
     * Store a newly created material in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:materials,name'
        ]);

        Material::createMaterial($validated);

        return redirect()->route('materials.index')->with('success', 'Material created successfully!');
    }

    /**
     * Display the specified material
     */
    public function show($id)
    {
        $material = Material::getMaterialById($id);
        return view('materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified material
     */
    public function edit($id)
    {
        $material = Material::getMaterialById($id);
        return view('materials.edit', compact('material'));
    }

    /**
     * Update the specified material in database
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:materials,name,' . $material->id,
        ]);

        try {
            $material->update([
                'name' => $request->name,
            ]);

            return redirect()->route('materials.index')
                ->with('success', 'Material updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('materials.index')
                ->withErrors(['name' => 'Failed to update material.'])
                ->with('edit_error_id', $material->id)
                ->withInput();
        }
    }

    /**
     * Remove the specified material from database
     */
    public function destroy($id)
    {
        Material::deleteMaterial($id);
        return redirect()->route('materials.index')->with('success', 'Material deleted successfully!');
    }
}
