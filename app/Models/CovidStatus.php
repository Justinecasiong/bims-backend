<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CovidStatus extends Model
{

    protected $guarded = [];

    public function resident()
    {
        return $this->belongsTo(Residents::class, 'resident_id', 'id');
    }
}
