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
        'classification_id',
        'color_id',
        'material_id',
        'stock_items',
        'availability',
        'SKU',
        'image'
    ];

    protected $dates = ['deleted_at'];

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
     * Get the classification that the item belongs to
     */
    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    /**
     * Get the color that the item belongs to
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * Get the material that the item belongs to
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Get all photos for the item
     */
    public function photos()
    {
        return $this->hasMany(ItemPhoto::class)->orderBy('order');
    }

    /**
     * Get all items with optional filtering
     */
    public static function getAllItems($includeTrashed = false)
    {
        if ($includeTrashed) {
            return self::withTrashed()->with(['type', 'category', 'classification', 'color', 'material', 'photos'])->orderBy('created_at', 'desc')->get();
        }
        return self::with(['type', 'category', 'classification', 'color', 'material', 'photos'])->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get a single item by ID
     */
    public static function getItemById($id)
    {
        return self::with(['type', 'category', 'classification', 'color', 'photos'])->findOrFail($id);
    }

    /**
     * Create a new item
     */
    public static function createItem(array $data)
    {
        // Handle image upload if present
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('items', 'public');
        }

        return self::create($data);
    }

    /**
     * Update an existing item
     */
    public static function updateItem($id, array $data)
    {
        $item = self::findOrFail($id);

        // Handle image upload if present
        if (isset($data['image']) && $data['image']) {
            // Delete old image if exists
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $data['image']->store('items', 'public');
        }

        $item->update($data);
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
