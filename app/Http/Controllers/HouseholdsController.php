<?php

namespace App\Http\Controllers;

use App\Http\Requests\HouseholdsRequest;
use App\Models\Households;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;

class HouseholdsController extends Controller
{
    public function index()
    {
        return response()->json(Households::with("zones")->paginate(10), 200);
    }

    public function store(Request $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Added a household number.'
        ]);
        return response()->json(Households::create($request->except('remember_token')), 200);
    }

    public function update(Request $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Updated a household number.'
        ]);
        $household = Households::find($request->id);
        $household->update($request->except('remember_token'));
        return response()->json($household, 200);
    }

    public function destroy($id, Request $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Deleted a household number.'
        ]);
        return response()->json(Households::destroy($id), 200);
    }
}
