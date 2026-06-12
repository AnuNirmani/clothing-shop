<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'contact' => ['required', 'email'],
            'delivery_method' => ['required', 'in:ship,pickup'],
            'country' => ['required', 'string', 'max:100'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'apartment' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:30'],
            'phone' => ['required', 'string', 'max:40'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['nullable', 'integer'],
            'items.*.name' => ['required', 'string', 'max:255'],
            'items.*.size' => ['nullable', 'string', 'max:100'],
            'items.*.color' => ['nullable', 'string', 'max:100'],
            'items.*.image' => ['nullable', 'string', 'max:2048'],
            'items.*.free_delivery' => ['nullable', 'boolean'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
        ]);

        $items = $validated['items'];
        $subtotal = collect($items)->sum(fn ($item) => (float) $item['price'] * (int) $item['quantity']);

        $isFreeDeliveryItem = count($items) === 1 && !empty($items[0]['free_delivery']);
        $baseShipping = ($subtotal > 5000 || $isFreeDeliveryItem) ? 0 : 450;
        $shippingCost = $validated['delivery_method'] === 'ship' ? $baseShipping : 0;
        $total = $subtotal + $shippingCost;

        $order = DB::transaction(function () use ($request, $validated, $items, $subtotal, $shippingCost, $total) {
            $stockAdjustments = collect($items)
                ->filter(fn ($item) => !empty($item['id']))
                ->groupBy('id')
                ->map(fn ($group) => $group->sum(fn ($item) => (int) $item['quantity']));

            $itemModels = collect();
            if ($stockAdjustments->isNotEmpty()) {
                $itemModels = Item::whereIn('id', $stockAdjustments->keys())
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                foreach ($stockAdjustments as $itemId => $orderedQty) {
                    $product = $itemModels->get((int) $itemId);

                    if (!$product) {
                        throw ValidationException::withMessages([
                            'items' => ['One or more selected items no longer exist. Please refresh and try again.'],
                        ]);
                    }

                    if ((int) $product->stock_items < (int) $orderedQty) {
                        throw ValidationException::withMessages([
                            'items' => ["Insufficient stock for {$product->name}. Only {$product->stock_items} left."],
                        ]);
                    }
                }
            }

            $order = Order::create([
                'order_number' => $this->generateOrderNumber(),
                'user_id' => $request->user()?->id,
                'contact_email' => $validated['contact'],
                'delivery_method' => $validated['delivery_method'],
                'country' => $validated['country'],
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'address' => $validated['address'],
                'apartment' => $validated['apartment'] ?? null,
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'phone' => $validated['phone'],
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'status' => 'confirmed',
            ]);

            foreach ($items as $item) {
                $qty = (int) $item['quantity'];
                $price = (float) $item['price'];

                $order->items()->create([
                    'item_id' => $item['id'] ?? null,
                    'name' => $item['name'],
                    'size' => $item['size'] ?? null,
                    'color' => $item['color'] ?? null,
                    'image' => $item['image'] ?? null,
                    'free_delivery' => (bool) ($item['free_delivery'] ?? false),
                    'quantity' => $qty,
                    'unit_price' => $price,
                    'line_total' => $qty * $price,
                ]);
            }

            foreach ($stockAdjustments as $itemId => $orderedQty) {
                $product = $itemModels->get((int) $itemId);
                if (!$product) {
                    continue;
                }

                $newStock = max(0, (int) $product->stock_items - (int) $orderedQty);
                $product->stock_items = $newStock;
                $product->availability = $newStock > 0;
                $product->save();
            }

            return $order;
        });

        return response()->json([
            'success' => true,
            'message' => 'Order confirmed and saved successfully.',
            'data' => [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'status' => $order->status,
                'total' => $order->total,
            ],
        ], 201);
    }

    private function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }
}
