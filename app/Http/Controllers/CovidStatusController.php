<?php

namespace App\Http\Controllers;

use App\Models\CovidStatus;
use App\Models\Residents;
use App\Http\Requests\CovidRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;


class CovidStatusController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $covid  = CovidStatus::with("resident")
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('vaccination_type', 'like', "%$search%");
                }
            })
            ->paginate(10);

        return response()->json($covid, 200);
    }

    public function store(CovidRequest $request)
    {
        return response()->json(CovidStatus::create($request->except('remember_token')), 200);
    }

    public function update(Request $request)
    {
        $covid = CovidStatus::find($request->id);
        $covid->update($request->except('remember_token'));
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Updated a COVID status.'
        ]);
        return response()->json($covid, 200);
    }

    public function findCovid(Request $request)
    {
        $resident = Residents::where(function ($query) use ($request) {
            if ($request) {
                $query->where('remember_token', 'like', "%$request->remember_token%");
            }
        })->get();


        $id = $resident[0]->id;

        $covid = CovidStatus::with('resident')
            ->where(function ($query) use ($id) {
                if ($id) {
                    $query->where('resident_id', 'like', "%$id%");
                }
            })->paginate();

        return response()->json($covid);
    }

    public function countUnvaccinated()
    {
        $resident = Residents::count();
        $unvaccinated = CovidStatus::where("vaccination_type", 'Unvaccinated')
            ->where('dose_num', 0)
            ->where('booster_type', 'Unvaccinated')->count();

        $total =  $unvaccinated / $resident;
        return response()->json($total);
    }

    public function countFirstDose()
    {
        $firstDoseData = [];
        $resident = Residents::count();
        $pfizer = CovidStatus::where("vaccination_type", 'Pfizer')
            ->where('dose_num', 1)
            ->where('booster_type', 'Unvaccinated')->count();

        $moderna = CovidStatus::where("vaccination_type", 'Moderna')
            ->where('dose_num', 1)
            ->where('booster_type', 'Unvaccinated')->count();
        $astra = CovidStatus::where("vaccination_type", 'Astrazeneca')
            ->where('dose_num', 1)
            ->where('booster_type', 'Unvaccinated')->count();
        $john = CovidStatus::where("vaccination_type", 'Johnson & Johnson')
            ->where('dose_num', 1)
            ->where('booster_type', 'Unvaccinated')->count();
        $sino = CovidStatus::where("vaccination_type", 'Sinovac')
            ->where('dose_num', 1)
            ->where('booster_type', 'Unvaccinated')->count();

        $pfizerTotal =  $pfizer / $resident;
        $modernaTotal =  $moderna / $resident;
        $astraTotal =  $astra / $resident;
        $johnTotal =  $john / $resident;
        $sinoTotal =  $sino / $resident;
        array_push($firstDoseData, $pfizerTotal, $modernaTotal,  $astraTotal,  $johnTotal, $sinoTotal);
        return response()->json($firstDoseData);
    }

    public function countSecondDose()
    {
        $firstDoseData = [];
        $resident = Residents::count();
        $pfizer = CovidStatus::where("vaccination_type", 'Pfizer')
            ->where('dose_num', 2)
            ->where('booster_type', 'Unvaccinated')->count();

        $moderna = CovidStatus::where("vaccination_type", 'Moderna')
            ->where('dose_num', 2)
            ->where('booster_type', 'Unvaccinated')->count();
        $astra = CovidStatus::where("vaccination_type", 'Astrazeneca')
            ->where('dose_num', 2)
            ->where('booster_type', 'Unvaccinated')->count();
        $john = CovidStatus::where("vaccination_type", 'Johnson & Johnson')
            ->where('dose_num', 2)
            ->where('booster_type', 'Unvaccinated')->count();
        $sino = CovidStatus::where("vaccination_type", 'Sinovac')
            ->where('dose_num', 2)
            ->where('booster_type', 'Unvaccinated')->count();

        $pfizerTotal =  $pfizer / $resident;
        $modernaTotal =  $moderna / $resident;
        $astraTotal =  $astra / $resident;
        $johnTotal =  $john / $resident;
        $sinoTotal =  $sino / $resident;
        array_push($firstDoseData, $pfizerTotal, $modernaTotal,  $astraTotal,  $johnTotal, $sinoTotal);
        return response()->json($firstDoseData);
    }

    public function countBooster()
    {
        $firstDoseData = [];
        $resident = Residents::count();
        $pfizer = CovidStatus::where('dose_num', 2)
            ->where('booster_type', 'Pfizer')->count();
        $moderna = CovidStatus::where('dose_num', 2)
            ->where('booster_type', 'Moderna')->count();
        $astra = CovidStatus::where('dose_num', 2)
            ->where('booster_type', 'Astrazeneca')->count();
        $john = CovidStatus::where('dose_num', 2)
            ->where('booster_type', 'Johnson & Johnson')->count();
        $sino = CovidStatus::where('dose_num', 2)
            ->where('booster_type', 'Sinovac')->count();

        $pfizerTotal =  $pfizer / $resident;
        $modernaTotal =  $moderna / $resident;
        $astraTotal =  $astra / $resident;
        $johnTotal =  $john / $resident;
        $sinoTotal =  $sino / $resident;
        array_push($firstDoseData, $pfizerTotal, $modernaTotal,  $astraTotal,  $johnTotal, $sinoTotal);
        return response()->json($firstDoseData);
    }
}
