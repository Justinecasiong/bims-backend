<?php

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Http\Requests\BlotterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;

class BlotterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $blotter  = Blotter::where(function ($query) use ($search) {
            if ($search) {
                $query->where('complainant', 'like', "%$search%");
            }
        })->paginate(10);
        return response()->json($blotter, 200);
    }

    public function store(BlotterRequest $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Created a blotter report.'
        ]);
        return response()->json(Blotter::create($request->except('remember_token')), 200);
    }

    public function update(BlotterRequest $request)
    {
        $blotter = Blotter::find($request->id);
        $blotter->update($request->except('remember_token'));
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Updated a bloter report.'
        ]);
        return response()->json($blotter, 200);
    }

    public function destroy(Request $request, $id)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Deleted a blotter report.'
        ]);
        return response()->json(Blotter::destroy($id), 200);
    }

    public function blotter_print(Request $request)
    {
        $search = $request->search;
        $blotter  = Blotter::where(function ($query) use ($search) {
            if ($search) {
                $query->where('id', 'like', "%$search%");
            }
        })->paginate(10);
        return response()->json($blotter, 200);
    }

    public function countActiveCases()
    {
        $blotter  = Blotter::where('blotter_status', 'like', "Active")->get()->count();
        return response($blotter);
    }

    public function countSettledCases()
    {
        $blotter  = Blotter::where('blotter_status', 'like', "Settled")->get()->count();
        return response($blotter);
    }

    public function countScheduledCases()
    {
        $blotter  = Blotter::where('blotter_status', 'like', "Scheduled")->get()->count();
        return response($blotter);
    }
}
