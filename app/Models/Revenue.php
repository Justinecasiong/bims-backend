<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{

    protected $guarded = [];

    public function residents()
    {
        return $this->belongsTo(Residents::class, 'resident_id', 'id');
    }
}
