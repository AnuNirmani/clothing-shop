<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    /**
     * Get the latest item overall
     */
    public function getLatestItem(): JsonResponse
    {
        $item = Item::where('availability', 'in stock')
            ->with(['category', 'type', 'colors'])
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
            ->where('availability', 'in stock')
            ->with(['category', 'type', 'colors'])
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
            ->where('availability', 'in stock')
            ->with(['category', 'type', 'colors'])
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
        $items = Item::where('availability', 'in stock')
            ->with(['category', 'type', 'colors'])
            ->latest()
            ->limit(4)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $items->map(fn($item) => $this->formatItem($item))
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
                ->where('availability', 'in stock')
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
     * Get items with filtering
     */
    public function getItems(Request $request): JsonResponse
    {
        $query = Item::where('availability', 'in stock')
            ->with(['category', 'type', 'colors']);

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('type_id')) {
            $query->where('type_id', $request->type_id);
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
            ->where('availability', 'in stock')
            ->with(['category', 'type', 'colors', 'photos', 'material', 'size', 'classifications'])
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
            'size_chart' => $item->size?->photo ? asset('storage/' . $item->size->photo) : null,
        ];
    }
}
