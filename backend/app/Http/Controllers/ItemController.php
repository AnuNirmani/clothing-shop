<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $classifications = \App\Models\Classification::getAllClassifications();
        $colors = \App\Models\Color::getAllColors();
        $materials = \App\Models\Material::getAllMaterials();
        $sizes = \App\Models\Size::getAllSizes();
        return view('items.create', compact('types', 'categories', 'classifications', 'colors', 'materials', 'sizes'));
    }

    /**
     * Store a newly created item in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'co_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'prize' => 'required|numeric|min:0',
            'type_id' => 'nullable|exists:types,id',
            'category_id' => 'nullable|exists:categories,id',
            'classification_id' => 'nullable|exists:classifications,id',
            'color_id' => 'nullable|exists:colors,id',
            'material_id' => 'nullable|exists:materials,id',
            'size_id' => 'nullable|exists:sizes,id',
            'size_id_dropdown' => 'nullable|exists:sizes,id',
            'stock_items' => 'required|integer|min:0',
            'availability' => 'required|in:in stock,out of stock',
            'SKU' => 'required|string|unique:items,SKU|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photos' => 'nullable|array|max:20',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Use size_id from radio buttons, or fall back to dropdown if radio not selected
        if (!$validated['size_id'] && isset($validated['size_id_dropdown'])) {
            $validated['size_id'] = $validated['size_id_dropdown'];
        }
        unset($validated['size_id_dropdown']);

        $item = Item::createItem($validated);

        // Handle multiple photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('items/photos', 'public');
                ItemPhoto::create([
                    'item_id' => $item->id,
                    'photo_path' => $path,
                    'order' => $index
                ]);
            }
        }

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
        $classifications = \App\Models\Classification::getAllClassifications();
        $colors = \App\Models\Color::getAllColors();
        $materials = \App\Models\Material::getAllMaterials();
        $sizes = \App\Models\Size::getAllSizes();
        return view('items.edit', compact('item', 'types', 'categories', 'classifications', 'colors', 'materials', 'sizes'));
    }

    /**
     * Update the specified item in database
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'co_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'prize' => 'required|numeric|min:0',
            'type_id' => 'nullable|exists:types,id',
            'category_id' => 'nullable|exists:categories,id',
            'classification_id' => 'nullable|exists:classifications,id',
            'color_id' => 'nullable|exists:colors,id',
            'material_id' => 'nullable|exists:materials,id',
            'size_id' => 'nullable|exists:sizes,id',
            'size_id_dropdown' => 'nullable|exists:sizes,id',
            'stock_items' => 'required|integer|min:0',
            'availability' => 'required|in:in stock,out of stock',
            'SKU' => 'required|string|max:255|unique:items,SKU,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photos' => 'nullable|array|max:20',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'exists:item_photos,id'
        ]);

        // Use size_id from radio buttons, or fall back to dropdown if radio not selected
        if (!$validated['size_id'] && isset($validated['size_id_dropdown'])) {
            $validated['size_id'] = $validated['size_id_dropdown'];
        }
        unset($validated['size_id_dropdown']);

        $item = Item::updateItem($id, $validated);

        // Handle photo deletions
        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = ItemPhoto::find($photoId);
                if ($photo && $photo->item_id == $id) {
                    Storage::disk('public')->delete($photo->photo_path);
                    $photo->delete();
                }
            }
        }

        // Handle new photo uploads
        if ($request->hasFile('photos')) {
            $currentCount = ItemPhoto::where('item_id', $id)->count();
            $maxOrder = ItemPhoto::where('item_id', $id)->max('order') ?? -1;
            
            foreach ($request->file('photos') as $index => $photo) {
                if ($currentCount >= 20) break;
                
                $path = $photo->store('items/photos', 'public');
                ItemPhoto::create([
                    'item_id' => $id,
                    'photo_path' => $path,
                    'order' => $maxOrder + $index + 1
                ]);
                $currentCount++;
            }
        }

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

