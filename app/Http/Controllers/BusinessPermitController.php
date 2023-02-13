<?php

namespace App\Http\Controllers;

use App\Models\BusinessPermit;
use App\Http\Requests\BusinessPermitRequest;
use Illuminate\Http\Request;

class BusinessPermitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $business_permit  = BusinessPermit::where(function ($query) use ($search) {
            if ($search) {
                $query->where('certification_request_id', 'like', "%$search%");
            }
        })->get();

        return response()->json($business_permit, 200);
    }

    public function store(BusinessPermitRequest $request)
    {
        return response()->json(BusinessPermit::create($request->all()), 200);
    }

    public function update(BusinessPermitRequest $request)
    {
        $business_permit = BusinessPermit::find($request->id);
        $business_permit->update($request->all());
        return response()->json($business_permit, 200);
    }

    public function destroy($id)
    {
        return response()->json(BusinessPermit::destroy($id), 200);
    }
}
