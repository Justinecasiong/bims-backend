<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gcash extends Model
{
    protected $table = 'gcash';
    protected $guarded = [];
    public function certification_request()
    {
        return $this->belongsTo(CertificationRequest::class, 'certification_request_id', 'id');
    }
}
