<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residents extends Model
{

    protected $guarded = [];

    public function zones()
    {
        return $this->belongsTo(Zones::class, 'zone_id', 'id');
    }

    public function covid()
    {
        return $this->hasOne(CovidStatus::class, 'id', 'resident_id');
    }

    public function certification_request()
    {
        return $this->hasMany(CerticationRequest::class, 'id', 'resident_id');
    }
}
