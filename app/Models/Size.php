<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'photo'];

    /**
     * Get all sizes
     */
    public static function getAllSizes()
    {
        return self::orderBy('name', 'asc')->get();
    }

    /**
     * Get a single size by ID
     */
    public static function getSizeById($id)
    {
        return self::findOrFail($id);
    }

    /**
     * Create a new size
     */
    public static function createSize(array $data)
    {
        return self::create($data);
    }

    /**
     * Update a size
     */
    public static function updateSize($id, array $data)
    {
        $size = self::findOrFail($id);
        $size->update($data);
        return $size;
    }

    /**
     * Delete a size
     */
    public static function deleteSize($id)
    {
        $size = self::findOrFail($id);
        return $size->delete();
    }

    /**
     * Get items of this size
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
