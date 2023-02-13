<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangayInformationSeeder extends Seeder
{
    public function run()
    {
        $province = "LEYTE";
        $municipality = "TACLOBAN CITY";
        $barangay = "BARANGAY 6-A STO. NIÑO EXT.";
        $contact_num = "(053) 300 -2436";
        $description = "";

        $date = Carbon::now();
        $createdDate = clone ($date);

        DB::table('barangay_information')->insert(
            [
                'province' => $province,
                'municipality' => $municipality,
                'barangay' => $barangay,
                'contact_num' => $contact_num,
                'province' => $province,
                'municipality_logo' => "",
                'barangay_logo' => "",
                'description' => $description,
                'created_at' => $createdDate,
                'updated_at' => $createdDate
            ]
        );
    }
}
