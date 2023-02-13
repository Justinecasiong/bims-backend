<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function index()
    {
        return response()->json(Certification::paginate(), 200);
    }

    public function store(Request $request)
    {
        return response()->json(Certification::create($request->all()), 200);
    }

    public function update(Request $request)
    {
        $certification = Certification::find($request->id);
        $certification->update($request->all());
        return response()->json($certification, 200);
    }

    public function destroy($id)
    {
        return response()->json(Certification::destroy($id), 200);
    }
}
