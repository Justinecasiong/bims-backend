<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChairmanshipSeeder extends Seeder
{
    public function run()
    {
        $chairmanships = [
            "Presiding Officer",
            "Committee on Infrastructure",
            "Committee on Finance",
            "Committee on Laws and Ordinance",
            "Committee on Education",
            "Committee on Peace and Order",
            "Committee on Health",
            "Committee on Agriculture",
            "Committee on Youth & Sports",
            "Non-elected officer",
        ];

        $date = Carbon::now();
        $createdDate = clone ($date);

        foreach ($chairmanships as $chairmanship) {
            DB::table('chairmanships')->insert(
                [
                    'chairmanship_description' => $chairmanship,
                    'created_at' => $createdDate,
                    'updated_at' => $createdDate
                ]
            );
        }
    }
}
