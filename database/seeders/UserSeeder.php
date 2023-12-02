<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "Muhammad Ikhsan Bintang",
                "email" => "ikhsanbintang1105@gmail.com",
                "password" => Hash::make("password"),
                "is_active" => true,
                "role" => "Admin",
            ],
            [
                "name" => "Headmaster",
                "email" => "headmaster@gmail.com",
                "password" => Hash::make("password"),
                "is_active" => true,
                "role" => "Headmaster",
            ],
        ];

        DB::table("users")->insert($data);
    }
}
