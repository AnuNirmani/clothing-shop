<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSizeLabel extends Model
{
    protected $fillable = ['item_id', 'size_label'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
