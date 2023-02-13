<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayOfficials extends Model
{

    protected $guarded = [];

    public function chairmanship()
    {
        return $this->belongsTo(Chairmanship::class, 'chairmanship_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Positions::class, 'position_id', 'id');
    }

    public function zones()
    {
        return $this->belongsTo(Zones::class, 'zone_id', 'id');
    }
}
