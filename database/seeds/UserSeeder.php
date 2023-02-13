<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        $name = "admin";
        $email = "admin@gmail.com";
        $password = Hash::make("admin");
        $remember_token = Hash::make(uniqid());
        $permission = "admin";

        $date = Carbon::now();
        $createdDate = clone ($date);

        DB::table('users')->insert(
            [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'permission' => $permission,
                'remember_token' => $remember_token,
                'created_at' => $createdDate,
                'updated_at' => $createdDate
            ]
        );
    }
}
