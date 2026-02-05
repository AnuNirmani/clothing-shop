<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'hex_code'];

    /**
     * Get all colors
     */
    public static function getAllColors()
    {
        return self::orderBy('name', 'asc')->get();
    }

    /**
     * Get a single color by ID
     */
    public static function getColorById($id)
    {
        return self::findOrFail($id);
    }

    /**
     * Create a new color
     */
    public static function createColor(array $data)
    {
        return self::create($data);
    }

    /**
     * Update an existing color
     */
    public static function updateColor($id, array $data)
    {
        $color = self::findOrFail($id);
        $color->update($data);
        return $color;
    }

    /**
     * Delete a color
     */
    public static function deleteColor($id)
    {
        $color = self::findOrFail($id);
        return $color->delete();
    }

    /**
     * Get all items that belong to this color
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
