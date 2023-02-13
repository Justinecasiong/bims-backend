<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            "Chairperson",
            "Secretary",
            "Treasurer",
            "Kagawad",
            "SK Chairman",
            "Chief Tanod",
            "Tanod",
            "BHW",
            "BNS",
            "BSPO",
            "Street Sweepers",
        ];

        $date = Carbon::now();
        $createdDate = clone ($date);

        foreach ($positions as $position) {
            DB::table('positions')->insert(
                [
                    'position_description' => $position,
                    'created_at' => $createdDate,
                    'updated_at' => $createdDate
                ]
            );
        }
    }
}
