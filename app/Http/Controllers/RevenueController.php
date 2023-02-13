<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevenueRequest;
use App\Models\Revenue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;


class RevenueController extends Controller
{
    public function getRevenue(Request $request)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->startDate)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->endDate)->endOfDay();
        $revenue = Revenue::with('residents')
            ->whereBetween('date', [$startDate, $endDate])
            ->paginate(10);
        return response()->json($revenue, 200);
    }

    public function index()
    {
        return response()->json(Revenue::with('residents')->paginate(10), 200);
    }

    public function store(RevenueRequest $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Added a revenue.'
        ]);
        return response()->json(Revenue::create($request->except('remember_token')), 200);
    }

    public function getTotalRevenue(Request $request)
    {
        $revenue = Revenue::whereYear('created_at', $request->year)->get();
        $barangay_clearance = $revenue->where('details', 'Barangay Clearance')->sum('amount');
        $barangay_certificate =  $revenue->where('details',  '==', 'Barangay Certificate')->sum('amount');
        $business_certificate = $revenue->where('details', 'Business Permit')->sum('amount');
        return response()->json([
            'revenue' => $revenue,
            'barangay_clearance' =>  $barangay_clearance,
            'barangay_certificate' =>  $barangay_certificate,
            'business_certificate' =>  $business_certificate
        ], 200);
    }

    public function getTotalRevenueByMonth()
    {
        $array = array();
        $months = [
            "January",
            "Febuary",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ];
        $count = 0;
        for ($i = 1; $i <= 12; $i++) {
            $months[$count] = Revenue::whereMonth('created_at', (string)$i)->get();
            $months[$count]->where('details', 'Business Permit')->sum('amount');

            $barangay_clearance = $months[$count]->where('details', 'Barangay Clearance')->sum('amount');
            $barangay_certificate =  $months[$count]->where('details',  '==', 'Barangay Certificate')->sum('amount');
            $business_certificate = $months[$count]->where('details', 'Business Permit')->sum('amount');
            $array[$count] =  [
                'barangay_clearance' =>  $barangay_clearance,
                'barangay_certificate' =>  $barangay_certificate,
                'business_certificate' =>  $business_certificate
            ];
            $count++;
        }
        return response()->json([
            'revenue' => $array,

        ], 200);
    }
}
