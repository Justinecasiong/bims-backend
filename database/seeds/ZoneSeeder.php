<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ZoneSeeder extends Seeder
{
    public function run()
    {
        $zones = [
            "Zone 1",
            "Zone 2",
            "Zone 3",
            "Zone 4",
            "Zone 5",
            "Zone 6",
            "Zone 7"
        ];

        $date = Carbon::now();
        $createdDate = clone ($date);

        foreach ($zones as $zone) {
            DB::table('zones')->insert(
                [
                    'zone_description' => $zone,
                    'details' => " ",
                    'created_at' => $createdDate,
                    'updated_at' => $createdDate
                ]
            );
        }
    }
}
