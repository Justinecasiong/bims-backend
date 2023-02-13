<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    protected $guarded = [];

    public function barangay_officials()
    {
        return $this->hasMany(BarangayOfficials::class, 'id', 'position_id');
    }
}
