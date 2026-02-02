<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of items
     */
    public function index()
    {
        $items = Item::getAllItems();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new item
     */
    public function create()
    {
        $types = \App\Models\Type::getAllTypes();
        $categories = \App\Models\Category::getAllCategories();
        return view('items.create', compact('types', 'categories'));
    }

    /**
     * Store a newly created item in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prize' => 'required|numeric|min:0',
            'color' => 'required|string|max:255',
            'type_id' => 'nullable|exists:types,id',
            'category_id' => 'nullable|exists:categories,id',
            'stock_items' => 'required|integer|min:0',
            'material' => 'required|string|max:255',
            'SKU' => 'required|string|unique:items,SKU|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        Item::createItem($validated);

        return redirect()->route('items.index')->with('success', 'Item created successfully!');
    }

    /**
     * Display the specified item
     */
    public function show($id)
    {
        $item = Item::getItemById($id);
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified item
     */
    public function edit($id)
    {
        $item = Item::getItemById($id);
        $types = \App\Models\Type::getAllTypes();
        $categories = \App\Models\Category::getAllCategories();
        return view('items.edit', compact('item', 'types', 'categories'));
    }

    /**
     * Update the specified item in database
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prize' => 'required|numeric|min:0',
            'color' => 'required|string|max:255',
            'type_id' => 'nullable|exists:types,id',
            'category_id' => 'nullable|exists:categories,id',
            'stock_items' => 'required|integer|min:0',
            'material' => 'required|string|max:255',
            'SKU' => 'required|string|max:255|unique:items,SKU,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        Item::updateItem($id, $validated);

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified item from database
     */
    public function destroy($id)
    {
        Item::deleteItem($id);
        return redirect()->route('items.index')->with('success', 'Item deleted successfully!');
    }
}

