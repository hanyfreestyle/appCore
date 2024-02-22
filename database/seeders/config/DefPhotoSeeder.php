<?php

namespace Database\Seeders\config;


use App\Models\admin\config\DefPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DefPhotoSeeder extends Seeder
{

    public function run(): void
    {

        DefPhoto::unguard();
        $tablePath = public_path('db/config_def_photos.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
