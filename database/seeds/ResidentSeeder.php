<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Residents;
use Carbon\Carbon;

class ResidentSeeder extends Seeder
{
    public function run()
    {
        $first_name = "Juan";
        $last_name = "Cruz";
        $place_of_birth = "Quezon City";
        $age = "20";
        $civil_status = "Single";
        $birthdate = "1999-02-02";
        $sex = "Male";
        $voter_status = "Yes";
        $identified_as = "Active";
        $email = "Juan@gmailo.com";
        $contact_num = "09547858596";
        $pwd_status = "No";
        $address = "askdflaksdfhlaksdjfhsaldjk";
        $remember_token = Hash::make(uniqid());
        $permission = "admin";

        $date = Carbon::now();
        $createdDate = clone ($date);

        DB::table('residents')->insert(
            [
                'first_name' => $first_name,
                'zone_id' => 1,
                'last_name' => $last_name,
                'place_of_birth' => $place_of_birth,
                'age' => $age,
                'civil_status' => $civil_status,
                'birthdate' => $birthdate,
                'sex' => $sex,
                'voter_status' => $voter_status,
                'identified_as' => $identified_as,
                'email' => $email,
                'contact_num' => $contact_num,
                'pwd_status' => $pwd_status,
                'address' => $address,
                'remember_token' => $remember_token,
                'created_at' => $createdDate,
                'updated_at' => $createdDate
            ]
        );

        $latest_resident = Residents::latest()->get();

        DB::table('covid_statuses')->insert(
            [
                'resident_id' => $latest_resident[0]->id,
                'vaccination_type' => "Unvaccinated",
                'dose_num' => 0,
                'booster_type' => "Unvaccinated",
                'reason' =>  "None",
                'created_at' => $createdDate,
                'updated_at' => $createdDate
            ]
        );

        DB::table('users')->insert(
            [
                'name' => $last_name . '' . $first_name . '' . str_replace('-', '', $birthdate),
                'password' => Hash::make($last_name . '' . $first_name . '' . str_replace('-', '', $birthdate)),
                'email' => $last_name . '' . $first_name . '' . str_replace('-', '', $birthdate) . '' . "@gmail.com",
                'permission' => "resident",
                'remember_token' => $latest_resident[0]->remember_token,
                'created_at' => $createdDate,
                'updated_at' => $createdDate
            ]
        );
    }
}
