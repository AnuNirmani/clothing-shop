<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'co_name',
        'description',
        'note',
        'prize',
        'type_id',
        'category_id',
        'material_id',
        'size_id',
        'size_label',
        'stock_items',
        'availability',
        'SKU',
        'image',
        'is_gift_card',
        'gift_card_validity_months',
        'is_on_offer',
        'offer_percentage',
        'offer_start_date',
        'offer_end_date',
        'discounted_price'
    ];

    protected $dates = ['deleted_at', 'offer_start_date', 'offer_end_date'];

    /**
     * Calculate discounted price
     */
    public static function calculateDiscountedPrice($prize, $is_on_offer, $offer_percentage)
    {
        if ($is_on_offer && $offer_percentage > 0) {
            return $prize - ($prize * ($offer_percentage / 100));
        }
        return $prize;
    }

    /**
     * Get the type that the item belongs to
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the category that the item belongs to
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the classifications that the item belongs to
     */
    public function classifications()
    {
        return $this->belongsToMany(Classification::class, 'classification_item');
    }

    /**
     * Get the colors that the item belongs to
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_item');
    }

    /**
     * Get the material that the item belongs to
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Get the size that the item belongs to
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    /**
     * Get all photos for the item
     */
    public function photos()
    {
        return $this->hasMany(ItemPhoto::class)->orderBy('order');
    }

    /**
     * Get the classification that the item belongs to
     */
    public function classification()
    {
        return $this->belongsTo(\App\Models\Classification::class);
    }

    /**
     * Get the color that the item belongs to
     */
    public function color()
    {
        return $this->belongsTo(\App\Models\Color::class);
    }

    /**
     * Get all items with optional filtering
     */
    public static function getAllItems($includeTrashed = false)
    {
        if ($includeTrashed) {
            return self::withTrashed()->with(['type', 'category', 'classifications', 'colors', 'material', 'size', 'photos'])->orderBy('created_at', 'desc')->get();
        }
        return self::with(['type', 'category', 'classifications', 'colors', 'material', 'size', 'photos'])->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get a single item by ID
     */
    public static function getItemById($id)
    {
        return self::with(['type', 'category', 'classifications', 'colors', 'photos'])->findOrFail($id);
    }

    /**
     * Create a new item
     */
    public static function createItem(array $data)
    {
        // Calculate discounted price
        $data['discounted_price'] = self::calculateDiscountedPrice(
            $data['prize'],
            $data['is_on_offer'] ?? false,
            $data['offer_percentage'] ?? 0
        );

        // Handle image upload if present
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('items', 'public');
        }

        $item = self::create($data);

        if (isset($data['classifications'])) {
            $item->classifications()->sync($data['classifications']);
        }
        if (isset($data['colors'])) {
            $item->colors()->sync($data['colors']);
        }

        return $item;
    }

    /**
     * Update an existing item
     */
    public static function updateItem($id, array $data)
    {
        $item = self::findOrFail($id);

        // Calculate discounted price
        $data['discounted_price'] = self::calculateDiscountedPrice(
            $data['prize'],
            $data['is_on_offer'] ?? false,
            $data['offer_percentage'] ?? 0
        );

        // Handle image upload if present
        if (isset($data['image']) && $data['image']) {
            // Delete old image if exists
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $data['image']->store('items', 'public');
        }

        $item->update($data);

        if (isset($data['classifications'])) {
            $item->classifications()->sync($data['classifications']);
        }
        if (isset($data['colors'])) {
            $item->colors()->sync($data['colors']);
        }

        return $item;
    }

    /**
     * Soft delete an item
     */
    public static function deleteItem($id)
    {
        $item = self::findOrFail($id);
        return $item->delete();
    }

    /**
     * Permanently delete an item
     */
    public static function forceDeleteItem($id)
    {
        $item = self::withTrashed()->findOrFail($id);
        
        // Delete image if exists
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        return $item->forceDelete();
    }

    /**
     * Restore a soft-deleted item
     */
    public static function restoreItem($id)
    {
        $item = self::withTrashed()->findOrFail($id);
        return $item->restore();
    }

    /**
     * Search items by name, SKU, category, or type
     */
    public static function searchItems($query)
    {
        return self::where('name', 'like', "%{$query}%")
            ->orWhere('SKU', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->orWhere('type', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get items by category
     */
    public static function getItemsByCategory($category)
    {
        return self::where('category', $category)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get items by type
     */
    public static function getItemsByType($type)
    {
        return self::where('type', $type)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get low stock items
     */
    public static function getLowStockItems($threshold = 10)
    {
        return self::where('stock_items', '<=', $threshold)
            ->orderBy('stock_items', 'asc')
            ->get();
    }
}
