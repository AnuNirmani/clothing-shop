<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'display_order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'display_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get stores ordered by display order
     */
    public static function getActive(): array
    {
        return static::where('active', true)
            ->orderBy('display_order')
            ->get()
            ->map(fn($store) => [
                'name' => $store->name,
                'address' => $store->address,
                'email' => $store->email,
                'phone' => $store->phone,
            ])
            ->toArray();
    }
}
