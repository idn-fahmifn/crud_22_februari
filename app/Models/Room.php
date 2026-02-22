<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_name', 'size', 'uuid'
    ]; 

    public function item()
    {
        return $this->hasMany(Item::class, 'room_id');
    }

}
