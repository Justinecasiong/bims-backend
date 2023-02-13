<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $guarded = [];

    public function barangay_officials()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
