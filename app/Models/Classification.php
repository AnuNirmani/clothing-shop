<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get all classifications
     */
    public static function getAllClassifications()
    {
        return self::orderBy('name', 'asc')->get();
    }

    /**
     * Get a single classification by ID
     */
    public static function getClassificationById($id)
    {
        return self::findOrFail($id);
    }

    /**
     * Create a new classification
     */
    public static function createClassification(array $data)
    {
        return self::create($data);
    }

    /**
     * Update an existing classification
     */
    public static function updateClassification($id, array $data)
    {
        $classification = self::findOrFail($id);
        $classification->update($data);
        return $classification;
    }

    /**
     * Delete a classification
     */
    public static function deleteClassification($id)
    {
        $classification = self::findOrFail($id);
        return $classification->delete();
    }

    /**
     * Get all items that belong to this classification
     */
    public function items()
    {
        return $this->belongsToMany(Item::class, 'classification_item');
    }
}
