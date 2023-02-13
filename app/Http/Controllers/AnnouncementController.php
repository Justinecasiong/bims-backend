<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;


class AnnouncementController extends Controller
{
    public function index()
    {
        return response()->json(Announcement::all(), 200);
    }

    public function store(Request $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Created an announcement.'
        ]);
        return response()->json(Announcement::create($request->except('remember_token')), 200);
    }

    public function update(Request $request)
    {
        $position = Announcement::find($request->id);
        $position->update($request->except('remember_token'));
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Updated an announcement.'
        ]);

        return response()->json($position, 200);
    }

    public function destroy(Request $request, $id)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Deleted an announcement.'
        ]);
        return response()->json(Announcement::destroy($id), 200);
    }
}
