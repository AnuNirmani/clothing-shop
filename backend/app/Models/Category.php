<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get all categories
     */
    public static function getAllCategories()
    {
        return self::orderBy('name', 'asc')->get();
    }

    /**
     * Get a single category by ID
     */
    public static function getCategoryById($id)
    {
        return self::findOrFail($id);
    }

    /**
     * Create a new category
     */
    public static function createCategory(array $data)
    {
        return self::create($data);
    }

    /**
     * Update a category
     */
    public static function updateCategory($id, array $data)
    {
        $category = self::findOrFail($id);
        $category->update($data);
        return $category;
    }

    /**
     * Delete a category
     */
    public static function deleteCategory($id)
    {
        $category = self::findOrFail($id);
        return $category->delete();
    }

    /**
     * Get items of this category
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
