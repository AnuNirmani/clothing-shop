<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\OfferCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of items
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = Item::with(['type', 'category', 'classifications', 'color', 'material', 'size', 'photos', 'colors'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('SKU', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // ✅ keeps ?search= across pagination pages

        return view('items.index', compact('items'));
    }

    /**
     * Display a read-only listing of offered items.
     */
    public function offeredItems(Request $request)
    {
        $search = $request->input('search');
        $selectedOfferCategoryId = $request->input('offer_category_id');

        $items = Item::with(['type', 'category', 'offerCategory'])
            ->where('is_on_offer', true)
            ->when($selectedOfferCategoryId, function ($query, $offerCategoryId) {
                $query->where('offer_category_id', $offerCategoryId);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('SKU', 'like', "%{$search}%")
                      ->orWhereHas('offerCategory', function ($offerQuery) use ($search) {
                          $offerQuery->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $offerCategories = OfferCategory::withCount([
            'items as offered_items_count' => function ($query) {
                $query->where('is_on_offer', true);
            },
        ])
            ->orderBy('name', 'asc')
            ->get();

        return view('items.offered', compact('items', 'offerCategories', 'selectedOfferCategoryId'));
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
        $offerCategories = OfferCategory::getAllOfferCategories();
        return view('items.create', compact('types', 'categories', 'classifications', 'colors', 'materials', 'sizes', 'offerCategories'));
    }

    /**
     * Store a newly created item in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'co_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'note' => 'nullable|string',
                'prize' => 'required|numeric|min:0',
                'type_id' => 'required|exists:types,id',
                'category_id' => 'required|exists:categories,id',
                'material_id' => 'required|exists:materials,id',
                'size_label' => 'nullable|in:S,M,L,XL,XXL',
                'size_id_dropdown' => 'nullable|exists:sizes,id',
                'stock_items' => 'required|integer|min:0',
                'availability' => 'required|in:in stock,out of stock',
                'SKU' => 'required|string|unique:items,SKU|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'photos' => 'nullable|array|max:20',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'classifications' => 'nullable|array',
                'classifications.*' => 'exists:classifications,id',
                'is_gift_card' => 'nullable|boolean',
                'gift_card_validity_months' => 'nullable|required_if:is_gift_card,1|integer|min:1',
                'is_on_offer' => 'nullable|boolean',
                'offer_start_date' => 'nullable|required_if:is_on_offer,1|date',
                'offer_end_date' => 'nullable|required_if:is_on_offer,1|date|after_or_equal:offer_start_date',
                'offer_category_id' => 'nullable|required_if:is_on_offer,1|exists:offer_categories,id',
                'colors' => 'required|array|min:1',
                'colors.*' => 'exists:colors,id',
            ],
            [
                // No custom messages needed
            ],
            [
                'stock_items' => 'stock quantity',
                'SKU' => 'SKU',
                'prize' => 'price',
                'type_id' => 'type',
                'category_id' => 'category',
                'material_id' => 'material',
                'size_label' => 'size',
                'size_id_dropdown' => 'size',
                'offer_category_id' => 'offer category',
                'colors' => 'color',
            ]
        );

        // One or both selections allowed
        if (!empty($validated['size_id_dropdown'])) {
            $validated['size_id'] = $validated['size_id_dropdown'];
        } else {
            $validated['size_id'] = null;
        }
        $validated['size_label'] = $validated['size_label'] ?? null;
        unset($validated['size_id_dropdown']);
        $validated['availability'] = $validated['availability'] === 'in stock';

        // Convert checkbox to boolean
        $validated['is_gift_card'] = $request->has('is_gift_card') ? true : false;
        
        // Clear gift card validity if not a gift card
        if (!$validated['is_gift_card']) {
            $validated['gift_card_validity_months'] = null;
        }

        // Handle offer fields
        $validated['is_on_offer'] = $request->has('is_on_offer') ? true : false;
        
        // Clear offer fields if not on offer
        if (!$validated['is_on_offer']) {
            $validated['offer_percentage'] = null;
            $validated['offer_start_date'] = null;
            $validated['offer_end_date'] = null;
            $validated['offer_category_id'] = null;
        } else {
            // Derive discount from the selected offer category
            $offerCat = \App\Models\OfferCategory::find($validated['offer_category_id']);
            $validated['offer_percentage'] = $offerCat ? $offerCat->discount_percentage : 0;
        }

        // Handle free delivery
        $validated['free_delivery'] = $request->has('free_delivery') ? true : false;

        $item = Item::createItem($validated);

        // Sync classifications (pivot)
        $item->classifications()->sync($validated['classifications'] ?? []);

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
        $offerCategories = OfferCategory::getAllOfferCategories();
        return view('items.edit', compact('item', 'types', 'categories', 'classifications', 'colors', 'materials', 'sizes', 'offerCategories'));
    }

    /**
     * Update the specified item in database
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'co_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'note' => 'nullable|string',
                'prize' => 'required|numeric|min:0',
                'type_id' => 'required|exists:types,id',
                'category_id' => 'required|exists:categories,id',
                'classifications' => 'nullable|array',
                'classifications.*' => 'exists:classifications,id',
                'colors' => 'required|array|min:1',
                'colors.*' => 'exists:colors,id',
                'material_id' => 'required|exists:materials,id',
                'size_label' => 'nullable|in:S,M,L,XL,XXL',
                'size_id_dropdown' => 'nullable|exists:sizes,id',
                'stock_items' => 'required|integer|min:0',
                'availability' => 'required|in:in stock,out of stock',
                'SKU' => 'required|string|max:255|unique:items,SKU,' . $id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'photos' => 'nullable|array|max:20',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'delete_photos' => 'nullable|array',
                'delete_photos.*' => 'exists:item_photos,id',
                'is_gift_card' => 'nullable|boolean',
                'gift_card_validity_months' => 'nullable|required_if:is_gift_card,1|integer|min:1',
                'is_on_offer' => 'nullable|boolean',
                'offer_start_date' => 'nullable|required_if:is_on_offer,1|date',
                'offer_end_date' => 'nullable|required_if:is_on_offer,1|date|after_or_equal:offer_start_date',
                'offer_category_id' => 'nullable|required_if:is_on_offer,1|exists:offer_categories,id',
            ],
            [
                // No custom messages needed
            ],
            [
                'stock_items' => 'stock quantity',
                'SKU' => 'SKU',
                'prize' => 'price',
                'type_id' => 'type',
                'category_id' => 'category',
                'material_id' => 'material',
                'size_label' => 'size',
                'size_id_dropdown' => 'size',
                'offer_category_id' => 'offer category',
                'colors' => 'color',
            ]
        );

        // One or both selections allowed
        if (!empty($validated['size_id_dropdown'])) {
            $validated['size_id'] = $validated['size_id_dropdown'];
        } else {
            $validated['size_id'] = null;
        }
        $validated['size_label'] = $validated['size_label'] ?? null;
        unset($validated['size_id_dropdown']);
        $validated['availability'] = $validated['availability'] === 'in stock';

        // Convert checkbox to boolean
        $validated['is_gift_card'] = $request->has('is_gift_card') ? true : false;
        
        // Clear gift card validity if not a gift card
        if (!$validated['is_gift_card']) {
            $validated['gift_card_validity_months'] = null;
        }

        // Handle offer fields
        $validated['is_on_offer'] = $request->has('is_on_offer') ? true : false;
        
        // Clear offer fields if not on offer
        if (!$validated['is_on_offer']) {
            $validated['offer_percentage'] = null;
            $validated['offer_start_date'] = null;
            $validated['offer_end_date'] = null;
            $validated['offer_category_id'] = null;
        } else {
            // Derive discount from the selected offer category
            $offerCat = \App\Models\OfferCategory::find($validated['offer_category_id']);
            $validated['offer_percentage'] = $offerCat ? $offerCat->discount_percentage : 0;
        }

        // Handle free delivery
        $validated['free_delivery'] = $request->has('free_delivery') ? true : false;

        $item = Item::updateItem($id, $validated);

        // Sync classifications (pivot)
        $item->classifications()->sync($validated['classifications'] ?? []);

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
