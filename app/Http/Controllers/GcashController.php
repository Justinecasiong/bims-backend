<?php

namespace App\Http\Controllers;

use App\Models\Gcash;
use App\Models\CertificationRequest;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\User;
use App\Models\Logs;


class GcashController extends Controller
{
    public function index()
    {
        return response()->json(Gcash::get(), 200);
    }

    public function store(Request $request)
    {
        if ($request->evidence != null) {
            $name = time() . '.' . explode('/', explode(':', substr($request->evidence, 0, strpos($request->evidence, ';')))[1])[1];
            Image::make($request->evidence)->save('evidence/' . $name);
            $request->merge(['evidence' => $name]);
        }

        $gcash = Gcash::create($request->all());

        $certification_request = CertificationRequest::find($request->certification_request_id);
        $certification_request->update(['status' => 'Paid']);
        return response()->json($gcash, 200);
    }

    public function findGcash(Request $request)
    {
        $search = $request->search;
        $gcash  = Gcash::where(function ($query) use ($search) {
            if ($search) {
                $query->where('certification_request_id', 'like', "%$search%");
            }
        })->with('certification_request')->get();

        return response()->json($gcash, 200);
    }
}
