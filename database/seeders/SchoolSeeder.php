<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
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
                "user_id" => "1",
                "name" => "SMKN 1 Depok",
                "code" => "SMKN1DPK",
                "principal" => "Learning By Doing",
                "email" => "ikhsanbintang1105@gmail.com",
                "phone_number" => "085155011637",
                "address" => "Jalan Tapos, Depok, Jawa barat",
                "logo" => "smkn1depok.jpg",
            ],
        ];

        DB::table("schools")->insert($data);
    }
}
