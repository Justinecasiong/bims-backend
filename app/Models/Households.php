<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Households extends Model
{

    protected $guarded = [];

    public function zones()
    {
        return $this->belongsTo(Zones::class, 'zone_id', 'id');
    }
}
