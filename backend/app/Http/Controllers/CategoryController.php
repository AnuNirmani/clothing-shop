<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index()
    {
        $categories = Category::getAllCategories();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        Category::createCategory($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified category
     */
    public function show($id)
    {
        $category = Category::getCategoryById($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit($id)
    {
        $category = Category::getCategoryById($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in database
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id
        ]);

        Category::updateCategory($id, $validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from database
     */
    public function destroy($id)
    {
        Category::deleteCategory($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
