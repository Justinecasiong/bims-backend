<?php

namespace App\Http\Controllers;

use App\Models\CertificationRequest;
use App\Models\Revenue;
use Illuminate\Http\Request;

class CertificationRequestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $certification_request = CertificationRequest::where(function ($query) use ($search) {
            if ($search) {
                $query->where('id', 'like', "%$search%");
            }
        })->with("certification")
            ->with("resident")->paginate(10);
        return response()->json($certification_request, 200);
    }

    public function store(Request $request)
    {
        return response()->json(CertificationRequest::create($request->all()), 200);
    }

    public function update(Request $request)
    {
        $certification_request = CertificationRequest::find($request->id);
        $certification_request->update($request->all());
        return response()->json($certification_request, 200);
    }

    public function destroy($id)
    {
        return response()->json(CertificationRequest::destroy($id), 200);
    }

    public function findResident(Request $request)
    {
        $certification_request = CertificationRequest::where(function ($query) use ($request) {
            if ($request) {
                $query->where('resident_id', 'like', "%$request->resident_id%");
            }
        })
            ->where('status', '!=', 'Rejected')
            ->where('status', '!=', 'Completed')
            ->with("certification")
            ->paginate(10);
        return response()->json($certification_request, 200);
    }

    public function updateCertificates(Request $request)
    {
        $certification_request = CertificationRequest::find($request->id);
        $certification_request->update(['status' => $request->status]);
        $this->createRevenue($request);
        return response()->json($certification_request, 200);
    }

    private function createRevenue($revenue)
    {
        $revenues = new Revenue;
        $revenues->details = $revenue->details;
        $revenues->amount = (int)$revenue->amount;
        $revenues->resident_id = $revenue->resident_id;
        $revenues->date = $revenue->date;
        $revenues->mode_of_payment = 'Via Gcash';
        $revenues->save();

        return $revenues;
    }
}
