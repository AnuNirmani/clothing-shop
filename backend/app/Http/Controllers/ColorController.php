<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of colors
     */
    public function index()
    {
        $colors = Color::getAllColors();
        return view('colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new color
     */
    public function create()
    {
        return view('colors.create');
    }

    /**
     * Store a newly created color in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:colors,name',
        ]);

        Color::createColor($validated);

        return redirect()->route('colors.index')->with('success', 'Color created successfully!');
    }

    /**
     * Display the specified color
     */
    public function show($id)
    {
        $color = Color::getColorById($id);
        return view('colors.show', compact('color'));
    }

    /**
     * Show the form for editing the specified color
     */
    public function edit($id)
    {
        $color = Color::getColorById($id);
        return view('colors.edit', compact('color'));
    }

    /**
     * Update the specified color in database
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:colors,name,' . $id,
        ]);

        Color::updateColor($id, $validated);

        return redirect()->route('colors.index')->with('success', 'Color updated successfully!');
    }

    /**
     * Remove the specified color from database
     */
    public function destroy($id)
    {
        Color::deleteColor($id);
        return redirect()->route('colors.index')->with('success', 'Color deleted successfully!');
    }
}
