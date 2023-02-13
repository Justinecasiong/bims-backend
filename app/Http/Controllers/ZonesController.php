<?php

namespace App\Http\Controllers;

use App\Models\Zones;

class ZonesController extends Controller
{
    public function index()
    {
        return response()->json(Zones::all(), 200);
    }
}
