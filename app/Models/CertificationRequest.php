<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificationRequest extends Model
{
    protected $guarded = [];

    public function certification()
    {
        return $this->belongsTo(Certification::class, 'certification_id', 'id');
    }

    public function resident()
    {
        return $this->belongsTo(Residents::class, 'resident_id', 'id');
    }
}
