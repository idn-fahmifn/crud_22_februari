<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'uuid', 'room_id', 'item_name', 'category', 'condition', 'image', 'stok'
    ];
}
