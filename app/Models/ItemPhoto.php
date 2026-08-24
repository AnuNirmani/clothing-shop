<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'photo_url',
        'photo_path',
    ];

    public function getPhotoPathAttribute()
    {
        return $this->attributes['photo_path'] ?? ($this->attributes['photo_url'] ?? null);
    }

    public function setPhotoPathAttribute($value): void
    {
        $this->attributes['photo_url'] = $value;
    }

    public function setPhotoUrlAttribute($value): void
    {
        $this->attributes['photo_url'] = $value;
    }

    /**
     * Get the item that owns the photo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
