<?php

namespace App\Http\Controllers;

use App\Models\GcashQR;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class GcashQRController extends Controller
{
    public function index()
    {
        return response()->json(GcashQR::get(), 200);
    }

    public function store(Request $request)
    {
        if ($request->image != null) {
            $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            Image::make($request->image)->save('qr_code/' . $name);
            $request->merge(['image' => $name]);
        }

        $gcash = GcashQR::create($request->all());
        return response()->json($gcash, 200);
    }


    public function update(Request $request)
    {
        $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        Image::make($request->image)->save('qr_code/' . $name);

        $latest_gcash = GcashQR::latest()->get();
        $gcash = GcashQR::find($latest_gcash[0]->id);
        $gcash->update(['image' => $name]);
        return response()->json($gcash, 200);
    }
}
