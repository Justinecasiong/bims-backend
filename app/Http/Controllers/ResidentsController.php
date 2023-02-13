<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResidentRequest;
use App\Models\CovidStatus;
use App\Models\User;
use App\Models\Residents;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Hash;
use App\Models\Logs;


class ResidentsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $resident  = Residents::with("zones")
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('first_name', 'like', "%$search%");
                }
            })
            ->orWhere(function ($query) use ($search) {
                if ($search) {
                    $query->where('last_name', 'like', "%$search%");
                }
            })
            ->paginate(10);

        return response()->json($resident, 200);
    }

    public function fetchResidents(Request $request)
    {
        return response()->json(Residents::all(), 200);
    }

    public function findByResidentID(Request $request)
    {
        $search = $request->search;
        $resident  = Residents::with("zones")
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('id', 'like', "%$search%");
                }
            })
            ->get();

        return response()->json($resident, 200);
    }

    public function pendingResidents()
    {
        $resident  = Residents::with("zones")
            ->where('status', 'Pending')
            ->paginate(10);

        return response()->json($resident, 200);
    }

    public function store(ResidentRequest $request)
    {
        if ($request->profile_pic != null) {
            $name = time() . '.' . explode('/', explode(':', substr($request->profile_pic, 0, strpos($request->profile_pic, ';')))[1])[1];
            Image::make($request->profile_pic)->save('img/' . $name);
            $request->merge(['profile_pic' => $name]);
        }
        if ($request->identification_img != null) {
            $name2 = time() . '.' . explode('/', explode(':', substr($request->identification_img, 0, strpos($request->identification_img, ';')))[1])[1];
            Image::make($request->identification_img)->save('identification/' . $name2);
            $request->merge(['identification_img' => $name2]);
        }

        $request->merge(['remember_token' => Hash::make(uniqid())]);
        $resident = Residents::create($request->except('remember_token'));

        $residents = Residents::latest()->first();

        $covid = new CovidStatus;
        $covid->resident_id = $residents->id;
        $covid->vaccination_type = "Unvaccinated";
        $covid->dose_num = 0;
        $covid->booster_type = 'Unvaccinated';
        $covid->reason = "None";
        $covid->save();

        $user = new User;
        $user->name = $residents->last_name . '' . $residents->first_name . '' . str_replace('-', '', $residents->birthdate);
        $user->password = Hash::make($residents->last_name . '' . $residents->first_name . '' . str_replace('-', '', $residents->birthdate));
        $user->email = $residents->last_name . '' . $residents->first_name . '' . str_replace('-', '', $residents->birthdate) . '' . "@gmail.com";
        $user->permission = "resident";
        $user->remember_token = $residents->remember_token;
        $user->save();

        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Added a resident.'
        ]);

        return response()->json($resident, 200);
    }

    public function acceptUser(Request $request)
    {
        $resident = Residents::find($request->id);
        $resident->update(['status' => 'Approved']);

        $covid = new CovidStatus;
        $covid->resident_id = $resident->id;
        $covid->vaccination_type = "Unvaccinated";
        $covid->dose_num = 0;
        $covid->booster_type = 'Unvaccinated';
        $covid->reason = "None";
        $covid->save();

        $user = new User;
        $user->name = $resident->last_name . '' . $resident->first_name . '' . str_replace('-', '', $resident->birthdate);
        $user->password = Hash::make($resident->last_name . '' . $resident->first_name . '' . str_replace('-', '', $resident->birthdate));
        $user->email = $resident->last_name . '' . $resident->first_name . '' . str_replace('-', '', $resident->birthdate) . '' . "@gmail.com";
        $user->permission = "resident";
        $user->remember_token = $resident->remember_token;
        $user->save();

        return response()->json($resident, 200);
    }

    public function update(ResidentRequest $request)
    {
        $resident = Residents::find($request->id);

        if ($request->profile_pic != null && $request->profile_pic != $resident->profile_pic) {
            $name = time() . '.' . explode('/', explode(':', substr($request->profile_pic, 0, strpos($request->profile_pic, ';')))[1])[1];
            Image::make($request->profile_pic)->save('img/' . $name);
            $request->merge(['profile_pic' => $name]);
        }

        $resident->update($request->except('remember_token'));
        return response()->json($resident, 200);
    }

    public function destroy($id)
    {
        return response()->json(Residents::destroy($id), 200);
    }

    public function findResident(Request $request)
    {
        $resident = Residents::with('zones')
            ->where(function ($query) use ($request) {
                if ($request) {
                    $query->where('remember_token', 'like', "%$request->remember_token%");
                }
            })->first();

        $user = User::where('remember_token', $request->remember_token)->first();

        return response()->json(['resident' => $resident, 'users' => $user], 200);
    }

    public function countTotalPopulation()
    {
        return response()->json(Residents::count());
    }
    public function countPopulation(Request $request)
    {
        $populationData = [];
        $resident = Residents::count();
        $male = Residents::where('sex', 'Male')->count();
        $female = Residents::where('sex', 'Female')->count();
        $pwd = Residents::where('pwd_status', 'Yes')->count();
        $senior = Residents::whereBetween('age', [60, 100])->count();
        $age = Residents::max('age');
        $dominant = Residents::where('age', $age)->count();
        $lgbtq = Residents::where('sex', 'LGBTQ')->count();

        $pfizerTotal =  $male;
        $modernaTotal =  $female;
        $astraTotal =  $pwd;
        $johnTotal =  $senior;
        $sinoTotal =  $dominant;
        array_push($populationData, $pfizerTotal, $modernaTotal,  $astraTotal,  $johnTotal, $sinoTotal, $age, $lgbtq);
        return response()->json($populationData);
    }

    public function updateProfile(Request $request)
    {
        $residents = Residents::where('remember_token',  $request->token)->first();
        $user = User::where('remember_token', $request->token)->first();

        if ($request->old_password) {
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->profile_pic != null && $request->profile_pic != $residents->profile_pic) {
                    $name = time() . '.' . explode('/', explode(':', substr($request->profile_pic, 0, strpos($request->profile_pic, ';')))[1])[1];
                    Image::make($request->profile_pic)->save('img/' . $name);
                    $request->merge(['profile_pic' => $name]);
                    $residents->update(['profile_pic' => $name]);
                }

                $user->update(['name' => $request->username, 'password' => Hash::make($request->password)]);
                return response()->json(['resident' => $residents, 'users' => $user], 200);
            } else {
                return response()->json("Incorrect Old Password! Please try again.", 400);
            }
        } else {
            if ($request->profile_pic != null && $request->profile_pic != $residents->profile_pic) {
                $name = time() . '.' . explode('/', explode(':', substr($request->profile_pic, 0, strpos($request->profile_pic, ';')))[1])[1];
                Image::make($request->profile_pic)->save('img/' . $name);
                $request->merge(['profile_pic' => $name]);
                $residents->update(['profile_pic' => $name]);
            }

            $user->update(['name' => $request->username]);
            return response()->json(['resident' => $residents, 'users' => $user], 200);
        }
    }

    public function updateAdminProfile(Request $request)
    {

        $user = User::where('remember_token', $request->token)->first();

        if ($request->old_password) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update(['name' => $request->username, 'password' => Hash::make($request->password)]);
                return response()->json(['users' => $user], 200);
            } else {
                return response()->json("Incorrect Old Password! Please try again.", 400);
            }
        } else {
            $user->update(['name' => $request->username]);
            return response()->json(['users' => $user], 200);
        }
    }
}
