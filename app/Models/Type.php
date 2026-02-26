<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
    ];

    /**
     * Get all types
     */
    public static function getAllTypes()
    {
        return self::orderBy('name', 'asc')->get();
    }

    /**
     * Get a single type by ID
     */
    public static function getTypeById($id)
    {
        return self::findOrFail($id);
    }

    /**
     * Create a new type
     */
    public static function createType(array $data)
    {
        return self::create($data);
    }

    /**
     * Update a type
     */
    public static function updateType($id, array $data)
    {
        $type = self::findOrFail($id);
        $type->update($data);
        return $type;
    }

    /**
     * Delete a type
     */
    public static function deleteType($id)
    {
        $type = self::findOrFail($id);
        return $type->delete();
    }

    /**
     * Get items of this type
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
