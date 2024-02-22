<?php

namespace Database\Seeders\admin;

use App\Models\admin\Amenity;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenitySeeder extends Seeder
{

    public function run(): void
    {
        Amenity::unguard();
        $tablePath = public_path('db/amenities.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
