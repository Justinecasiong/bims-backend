<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Positions;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;


class PositionsController extends Controller
{
    public function index()
    {
        return response()->json(Positions::paginate(10), 200);
    }

    public function getPositions()
    {
        return response()->json(Positions::all(), 200);
    }

    public function store(PositionRequest $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Created a barangay position.'
        ]);
        return response()->json(Positions::create($request->except('remember_token')), 200);
    }

    public function update(PositionRequest $request)
    {
        $position = Positions::find($request->id);
        $position->update($request->except('remember_token'));
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Updated a barangay position.'
        ]);
        return response()->json($position, 200);
    }

    public function destroy($id, Request $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Deleted a barangay position.'
        ]);
        return response()->json(Positions::destroy($id), 200);
    }
}
