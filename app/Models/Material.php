<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get all materials
     */
    public static function getAllMaterials()
    {
        return self::orderBy('name', 'asc')->get();
    }

    /**
     * Get a single material by ID
     */
    public static function getMaterialById($id)
    {
        return self::findOrFail($id);
    }

    /**
     * Create a new material
     */
    public static function createMaterial(array $data)
    {
        return self::create($data);
    }

    /**
     * Update a material
     */
    public static function updateMaterial($id, array $data)
    {
        $material = self::findOrFail($id);
        $material->update($data);
        return $material;
    }

    /**
     * Delete a material
     */
    public static function deleteMaterial($id)
    {
        $material = self::findOrFail($id);
        return $material->delete();
    }

    /**
     * Get items of this material
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
