<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        return response()->json(User::where(function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'like', "%$search%");
            }
        })->paginate(10), 200);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $password = $user->name;
        $user->update(['password' => bcrypt($password)]);
        return response()->json($user, 200);
    }

    public function updateStatus(Request $request)
    {
        $user = User::find($request->id);
        $status = '';

        if ($request->status == 'active') {
            $status = 'non-active';
        } else {
            $status = 'active';
        }
        $user->update(['reason' => $request->reason, 'status' => $status]);
        return response()->json($user, 200);
    }
}
