<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $createdDate = clone ($date);

        DB::table('certifications')->insert([
            [
                'certification_description' => "Barangay Certificate",
                'title' => "BARANGAY CERTIFICATION",
                'price' => "180.00",
                'created_at' => $createdDate,
                'updated_at' => $createdDate
            ],
            [
                'certification_description' => "Barangay Clearance",
                'title' => "BARANGAY CLEARANCE",
                'price' => "180.00",
                'created_at' => $createdDate,
                'updated_at' => $createdDate
            ],
            [
                'certification_description' => "Certificate of Indigency",
                'title' => "CERTIFICATE OF INDIGENCY",
                'price' => null,
                'created_at' => $createdDate,
                'updated_at' => $createdDate
            ],
            [
                'certification_description' => "Business Permit",
                'title' => "BUSINESS PERMIT",
                'price' => "180.00",
                'created_at' => $createdDate,
                'updated_at' => $createdDate
            ]
        ]);
    }
}
