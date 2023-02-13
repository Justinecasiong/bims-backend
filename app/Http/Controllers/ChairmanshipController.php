<?php

namespace App\Http\Controllers;

use App\Models\Chairmanship;
use App\Http\Requests\ChairmanshipRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;


class ChairmanshipController extends Controller
{
    public function index()
    {
        return response()->json(Chairmanship::paginate(10), 200);
    }

    public function store(ChairmanshipRequest $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Created a chairmanship.'
        ]);
        return response()->json(Chairmanship::create($request->except('remember_token')), 200);
    }

    public function update(ChairmanshipRequest $request, $id)
    {
        $chairmanship = Chairmanship::where('id', $id);
        $chairmanship->update($request->except('remember_token'));
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Updated a chairmanship.'
        ]);
        return response()->json($chairmanship, 200);
    }

    public function destroy($id, Request $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Deleted a chairmanshipt.'
        ]);
        return response()->json(Chairmanship::destroy($id), 200);
    }
}
