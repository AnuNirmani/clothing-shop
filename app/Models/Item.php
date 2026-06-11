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
        'offer_category_id',
        'material_id',
        'size_id',
        'size_label',
        'stock_items',
        'stock',
        'availability',
        'SKU',
        'image',
        'is_gift_card',
        'gift_card_validity_months',
        'is_on_offer',
        'offer_percentage',
        'offer_start_date',
        'offer_end_date',
        'discounted_price',
        'free_delivery',
    ];

    protected $dates = ['deleted_at', 'offer_start_date', 'offer_end_date'];

    // ✅ Cast availability, is_gift_card, is_on_offer to boolean
    protected $casts = [
        'availability'   => 'boolean',
        'is_gift_card'   => 'boolean',
        'is_on_offer'    => 'boolean',
        'free_delivery'  => 'boolean',
    ];

    public function setAvailabilityAttribute($value): void
    {
        if (is_string($value)) {
            $normalized = strtolower(trim($value));
            $this->attributes['availability'] = $normalized === 'in stock';
            return;
        }

        $this->attributes['availability'] = (bool) $value;
    }

    public function setStockItemsAttribute($value): void
    {
        $stock = (int) $value;

        $this->attributes['stock_items'] = $stock;
        $this->attributes['stock'] = $stock;
    }

    // ─────────────────────────────────────────
    // Helper Methods
    // ─────────────────────────────────────────

    /**
     * Calculate discounted price based on offer
     */
    public static function calculateDiscountedPrice($prize, $is_on_offer, $offer_percentage)
    {
        if ($is_on_offer && $offer_percentage > 0) {
            return $prize - ($prize * ($offer_percentage / 100));
        }
        return $prize;
    }

    // ─────────────────────────────────────────
    // Relationships
    // ─────────────────────────────────────────

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function offerCategory()
    {
        return $this->belongsTo(OfferCategory::class);
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class, 'classification_item');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_item');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function photos()
    {
        return $this->hasMany(ItemPhoto::class)->orderBy('order');
    }

    // Singular aliases kept for backward compatibility
    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    // ─────────────────────────────────────────
    // Static Query Methods
    // ─────────────────────────────────────────

    /**
     * Get all items with optional soft-deleted
     */
    public static function getAllItems($includeTrashed = false)
    {
        $query = $includeTrashed ? self::withTrashed() : self::query();

        return $query
            ->with(['type', 'category', 'offerCategory', 'classifications', 'colors', 'material', 'size', 'photos'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get a single item by ID with relationships
     */
    public static function getItemById($id)
    {
        return self::with(['type', 'category', 'offerCategory', 'classifications', 'colors', 'photos'])
            ->findOrFail($id);
    }

    /**
     * Create a new item
     * ✅ availability is passed in from controller (auto-calculated from stock_items)
     */
    public static function createItem(array $data)
    {
        // Calculate discounted price
        $data['discounted_price'] = self::calculateDiscountedPrice(
            $data['prize'],
            $data['is_on_offer'] ?? false,
            $data['offer_percentage'] ?? 0
        );

        // Handle main image upload
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('items', 'public');
        }

        $item = self::create($data);

        // Sync pivot tables
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
     * ✅ availability is passed in from controller (auto-calculated from stock_items)
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

        // Handle main image upload
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $data['image']->store('items', 'public');
        }

        $item->update($data);

        // Sync pivot tables
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
        return self::findOrFail($id)->delete();
    }

    /**
     * Permanently delete an item and its image
     */
    public static function forceDeleteItem($id)
    {
        $item = self::withTrashed()->findOrFail($id);

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
        return self::withTrashed()->findOrFail($id)->restore();
    }

    /**
     * Search items by name or SKU
     */
    public static function searchItems($query)
    {
        return self::where('name', 'like', "%{$query}%")
            ->orWhere('SKU', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get items with low stock
     */
    public static function getLowStockItems($threshold = 5)
    {
        return self::where('stock_items', '>', 0)
            ->where('stock_items', '<=', $threshold)
            ->orderBy('stock_items', 'asc')
            ->get();
    }

    /**
     * Get out of stock items
     */
    public static function getOutOfStockItems()
    {
        return self::where('stock_items', 0)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
