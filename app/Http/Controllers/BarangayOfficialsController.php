<?php

namespace App\Http\Controllers;

use App\Models\BarangayOfficials;
use App\Models\Positions;
use App\Http\Requests\BarangayOfficialsRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Logs;

class BarangayOfficialsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $officials  = BarangayOfficials::with(["chairmanship", "position", "zones"])
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('fullname', 'like', "%$search%");
                }
            })
            ->orderBy('position_id')
            ->paginate(10);

        return response()->json($officials, 200);
    }

    public function getOfficials()
    {
        return response()->json(BarangayOfficials::with(["chairmanship", "position"])->get(), 200);
    }

    public function store(BarangayOfficialsRequest $request)
    {
        $officials = new BarangayOfficials;

        if ($request->profile_pic != null) {
            $name = time() . '.' . explode('/', explode(':', substr($request->profile_pic, 0, strpos($request->profile_pic, ';')))[1])[1];
            Image::make($request->profile_pic)->save('img/' . $name);
            $officials->profile_pic = $name;
        }

        $officials->chairmanship_id = $request->chairmanship_id;
        $officials->position_id = $request->position_id;
        $officials->zone_id = $request->zone_id;
        $officials->fullname = $request->fullname;
        $officials->term_start = $request->term_start;
        $officials->term_end = $request->term_end;
        $officials->status = $request->status;
        $officials->contact_num = $request->contact_num;
        $officials->remember_token = Hash::make(uniqid());
        $officials->save();

        $latest_officials = BarangayOfficials::latest()->get();
        $position = Positions::where('id', $request->position_id)->get();
        $user = new User;
        $user->name = str_replace(' ', '', $request->fullname);
        $user->password = Hash::make(str_replace(' ', '', $request->fullname));
        $user->email = str_replace(' ', '', $request->fullname) . '' . str_replace('-', '', $request->birthdate) . '' . "@gmail.com";
        $user->permission = strtolower($position[0]->position_description);
        $user->remember_token = $latest_officials[0]->remember_token;
        $user->save();

        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Officer ' .  $request->fullname . ' has been added.'
        ]);

        return response()->json($officials, 200);
    }

    public function update(BarangayOfficialsRequest $request)
    {
        $officials = BarangayOfficials::find($request->id);
        if ($request->profile_pic != null && $request->profile_pic != $officials->profile_pic) {
            $name = time() . '.' . explode('/', explode(':', substr($request->profile_pic, 0, strpos($request->profile_pic, ';')))[1])[1];
            Image::make($request->profile_pic)->save('img/' . $name);
            $request->merge(['profile_pic' => $name]);
        }
        $officials->update($request->except('remember_token'));

        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Officer ' .  $request->fullname . ' has been updated.'
        ]);
        return response()->json($officials, 200);
    }

    public function destroy(Request $request)
    {
        $officials = BarangayOfficials::destroy($request->id);
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Officer ' .  $request->fullname . ' has been deleted.'
        ]);

        return response()->json($officials, 200);
    }

    public function findOfficial(Request $request)
    {
        $resident = BarangayOfficials::with(["chairmanship", "position", "zones"])
            ->where(function ($query) use ($request) {
                if ($request) {
                    $query->where('remember_token', 'like', "%$request->remember_token%");
                }
            })->first();

        $user = User::where('remember_token', $request->remember_token)->first();

        return response()->json(['officials' => $resident, 'users' => $user], 200);
    }

    public function findOfficialID(Request $request)
    {
        $officials = BarangayOfficials::with(["chairmanship", "position", "zones"])
            ->where(function ($query) use ($request) {
                if ($request) {
                    $query->where('id', 'like', "%$request->id%");
                }
            })->first();

        return response()->json($officials, 200);
    }

    public function updateProfile(Request $request)
    {
        $officials = BarangayOfficials::where('remember_token',  $request->token)->first();
        $user = User::where('remember_token', $request->token)->first();

        if ($request->old_password) {
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->profile_pic != null && $request->profile_pic != $officials->profile_pic) {
                    $name = time() . '.' . explode('/', explode(':', substr($request->profile_pic, 0, strpos($request->profile_pic, ';')))[1])[1];
                    Image::make($request->profile_pic)->save('img/' . $name);
                    $officials->update(['fullname' => $request->fullname, 'profile_pic' => $name]);
                } else {
                    $officials->update(['fullname' => $request->fullname]);
                }


                $user->update(['name' => $request->username, 'password' => Hash::make($request->password)]);
                return response()->json(['officials' => $officials, 'users' => $user], 200);
            } else {
                return response()->json("Incorrect Old Password! Please try again.", 400);
            }
        } else {
            if ($request->profile_pic != null && $request->profile_pic != $officials->profile_pic) {
                $name = time() . '.' . explode('/', explode(':', substr($request->profile_pic, 0, strpos($request->profile_pic, ';')))[1])[1];
                Image::make($request->profile_pic)->save('img/' . $name);
                $request->merge(['profile_pic' => $name]);
            }
            $officials->update(['fullname' => $request->fullname, 'profile_pic' => $name]);
            $user->update(['name' => $request->username]);
            return response()->json(['officials' => $officials, 'users' => $user], 200);
        }
    }
}
