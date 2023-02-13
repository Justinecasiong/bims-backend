<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{

    protected $guarded = [];

    public function certification_request()
    {
        return $this->hasMany(CerticationRequest::class, 'id', 'certication_id');
    }
}
