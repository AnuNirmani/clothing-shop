<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'contact_email',
        'delivery_method',
        'country',
        'first_name',
        'last_name',
        'address',
        'apartment',
        'city',
        'postal_code',
        'phone',
        'subtotal',
        'shipping_cost',
        'total',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
