<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\SiteSetting;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    /**
     * Get the latest item overall
     */
    public function getLatestItem(): JsonResponse
    {
        $item = Item::where('availability', true)
            ->with(['category', 'offerCategory', 'type', 'colors'])
            ->latest()
            ->first();

        return response()->json([
            'success' => true,
            'data' => $item ? $this->formatItem($item) : null
        ]);
    }

    /**
     * Get the latest women's wear item (category_id = 2)
     */
    public function getLatestWomensItem(): JsonResponse
    {
        $item = Item::where('category_id', 2)
            ->where('availability', true)
            ->with(['category', 'offerCategory', 'type', 'colors'])
            ->latest()
            ->first();

        return response()->json([
            'success' => true,
            'data' => $item ? $this->formatItem($item) : null
        ]);
    }

    /**
     * Get the latest men's wear item (category_id = 3)
     */
    public function getLatestMensItem(): JsonResponse
    {
        $item = Item::where('category_id', 1)
            ->where('availability', true)
            ->with(['category', 'offerCategory', 'type', 'colors'])
            ->latest()
            ->first();

        return response()->json([
            'success' => true,
            'data' => $item ? $this->formatItem($item) : null
        ]);
    }

    /**
     * Get the latest 4 items
     */
    public function getLatestFourItems(): JsonResponse
    {
        $items = Item::where('availability', true)
            ->with(['category', 'offerCategory', 'type', 'colors'])
            ->latest()
            ->limit(4)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $items->map(fn($item) => $this->formatItem($item))
        ]);
    }

    /**
     * Get active offered items for homepage offer section
     */
    public function getOfferedItems(): JsonResponse
    {
        $today = Carbon::today();

        $items = Item::where('availability', true)
            ->where('is_on_offer', true)
            ->where(function ($query) use ($today) {
                $query->whereNull('offer_start_date')
                    ->orWhereDate('offer_start_date', '<=', $today);
            })
            ->where(function ($query) use ($today) {
                $query->whereNull('offer_end_date')
                    ->orWhereDate('offer_end_date', '>=', $today);
            })
            ->with(['category', 'type', 'colors'])
            ->with('offerCategory')
            ->orderByRaw('CASE WHEN offer_end_date IS NULL THEN 1 ELSE 0 END')
            ->orderBy('offer_end_date', 'asc')
            ->latest()
            ->limit(4)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $items->map(fn($item) => $this->formatItem($item))
        ]);
    }

    /**
     * Get homepage hero media managed from admin panel
     */
    public function getHomeHeroImage(): JsonResponse
    {
        $heroImage = SiteSetting::getValue('home_hero_image');
        $heroVideo = SiteSetting::getValue('home_hero_video');

        return response()->json([
            'success' => true,
            'data' => [
                'image' => $heroImage ? asset('storage/' . $heroImage) : null,
                'video' => $heroVideo ? asset('storage/' . $heroVideo) : null,
            ],
        ]);
    }

    public function getHomeHeroButtons(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => SiteSetting::getHeroButtons(),
        ]);
    }

    /**
     * Get 8 types and the image of the last item added for each type
     */
    public function getTypesWithLatestItem(): JsonResponse
    {
        $types = Type::limit(8)->get();

        $data = $types->map(function ($type) {
            $latestItem = Item::where('type_id', $type->id)
                ->where('availability', true)
                ->latest()
                ->first();

            return [
                'type_id' => $type->id,
                'type_name' => $type->name,
                'item_image' => $latestItem && $latestItem->image ? asset('storage/' . $latestItem->image) : null
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Get types by category id
     */
    public function getTypesByCategory(int $categoryId): JsonResponse
    {
        $types = Type::where('category_id', $categoryId)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $types->map(fn($type) => [
                'id' => $type->id,
                'name' => $type->name
            ])
        ]);
    }

    /**
     * Get all categories with their types
     */
    public function getCategoriesWithTypes(): JsonResponse
    {
        $types = Type::with('category')
            ->orderBy('name', 'asc')
            ->get()
            ->filter(fn($type) => $type->category !== null);

        $grouped = $types
            ->groupBy(fn($type) => $type->category->id)
            ->map(function ($typesByCategory) {
                $category = $typesByCategory->first()->category;

                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'types' => $typesByCategory
                        ->sortBy('name')
                        ->values()
                        ->map(fn($type) => [
                            'id' => $type->id,
                            'name' => $type->name,
                        ]),
                ];
            })
            ->values()
            ->sortBy('name')
            ->values();

        return response()->json([
            'success' => true,
            'data' => $grouped,
        ]);
    }

    /**
     * Get items with filtering
     */
    public function getItems(Request $request): JsonResponse
    {
        $query = Item::where('availability', true)
            ->with(['category', 'offerCategory', 'type', 'colors']);

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('type_id')) {
            $query->where('type_id', $request->type_id);
        }

        if ($request->has('offer_category_id')) {
            $query->where('offer_category_id', $request->offer_category_id);
        }

        if ($request->has('latest')) {
            $query->latest()->limit(12);
        } else {
            $query->latest();
        }

        $items = $query->get();

        return response()->json([
            'success' => true,
            'data' => $items->map(fn($item) => $this->formatItem($item))
        ]);
    }

    /**
     * Get a single item by id
     */
    public function getItemById(int $id): JsonResponse
    {
        $item = Item::where('id', $id)
            ->where('availability', true)
            ->with(['category', 'offerCategory', 'type', 'colors', 'photos', 'material', 'size', 'classifications'])
            ->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatItem($item)
        ]);
    }

    /**
     * Format item data for API response
     */
    private function formatItem($item): array
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'co_name' => $item->co_name,
            'SKU' => $item->SKU,
            'description' => $item->description,
            'note' => $item->note,
            'prize' => $item->prize,
            'image' => $item->image ? asset('storage/' . $item->image) : null,
            'category' => $item->category?->name,
            'offer_category' => $item->offerCategory?->name,
            'type' => $item->type?->name,
            'stock_items' => $item->stock_items,
            'availability' => $item->availability,
            'material' => $item->material?->name,
            'size' => $item->size?->name,
            'size_label' => $item->size_label,
            'is_gift_card' => $item->is_gift_card,
            'gift_card_validity_months' => $item->gift_card_validity_months,
            'is_on_offer' => $item->is_on_offer,
            'offer_percentage' => $item->offer_percentage,
            'offer_start_date' => $item->offer_start_date,
            'offer_end_date' => $item->offer_end_date,
            'colors' => $item->colors->map(fn($color) => [
                'name' => $color->name,
                'hex' => $color->hex_code
            ]),
            'classifications' => $item->classifications->map(fn($c) => $c->name),
            'photos' => $item->photos->map(fn($photo) => [
                'url' => asset('storage/' . $photo->photo_path)
            ]),
            'installment_3' => number_format(($item->discounted_price ?? $item->prize) / 3, 2, '.', ''),
            'installment_4' => number_format(($item->discounted_price ?? $item->prize) / 4, 2, '.', ''),
            'discounted_price' => $item->discounted_price,
            'free_delivery' => (bool) $item->free_delivery,
            'size_chart' => $item->size?->photo ? asset('storage/' . $item->size->photo) : null,
        ];
    }
}
