<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'location_name', 'size', 'notes', 'uuid'
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'location_id');
    }
}
