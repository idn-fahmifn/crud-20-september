<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $fillable = [
        'item_name', 'brand', 'stock', 'uuid', 'photo', 'desc', 'location_id'
    ];

    public function location() : BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

}
