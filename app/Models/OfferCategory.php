<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'discount_percentage'];

    protected $casts = [
        'discount_percentage' => 'float',
    ];

    /**
     * Get all offer categories.
     */
    public static function getAllOfferCategories()
    {
        return self::orderBy('name', 'asc')->get();
    }

    /**
     * Get one offer category by id.
     */
    public static function getOfferCategoryById($id)
    {
        return self::findOrFail($id);
    }

    /**
     * Create an offer category.
     */
    public static function createOfferCategory(array $data)
    {
        return self::create($data);
    }

    /**
     * Update an offer category.
     */
    public static function updateOfferCategory($id, array $data)
    {
        $offerCategory = self::findOrFail($id);
        $offerCategory->update($data);

        return $offerCategory;
    }

    /**
     * Delete an offer category.
     */
    public static function deleteOfferCategory($id)
    {
        $offerCategory = self::findOrFail($id);

        return $offerCategory->delete();
    }

    /**
     * Items assigned to this offer category.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
