<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zones extends Model
{
    protected $guarded = [];

    public function resident()
    {
        return $this->hasMany(Residents::class, 'id', 'zone_id');
    }

    public function household()
    {
        return $this->hasMany(Households::class, 'id', 'zone_id');
    }

    public function officials()
    {
        return $this->hasMany(BarangayOfficials::class, 'id', 'zone_id');
    }
}
