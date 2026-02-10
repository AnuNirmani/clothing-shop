<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    /**
     * Get the latest item overall
     */
    public function getLatestItem(): JsonResponse
    {
        $item = Item::with(['category', 'type', 'colors'])
            ->latest('id')
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
            ->with(['category', 'type', 'colors'])
            ->latest('id')
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
            ->with(['category', 'type', 'colors'])
            ->latest('id')
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
        $items = Item::with(['category', 'type', 'colors'])
            ->latest('id')
            ->limit(4)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $items->map(fn($item) => $this->formatItem($item))
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
            'prize' => $item->prize,
            'image' => $item->image ? asset('storage/' . $item->image) : null,
            'category' => $item->category?->name,
            'type' => $item->type?->name,
            'stock' => $item->stock_items,
            'availability' => 'in stock'
        ];
    }
}
