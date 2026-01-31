<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of types
     */
    public function index()
    {
        $types = Type::getAllTypes();
        return view('types.index', compact('types'));
    }

    /**
     * Show the form for creating a new type
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Store a newly created type in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:types,name'
        ]);

        Type::createType($validated);

        return redirect()->route('types.index')->with('success', 'Type created successfully!');
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
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:types,name,' . $id
        ]);

        Type::updateType($id, $validated);

        return redirect()->route('types.index')->with('success', 'Type updated successfully!');
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
