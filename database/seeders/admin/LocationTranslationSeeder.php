<?php

namespace Database\Seeders\admin;

use App\Models\admin\LocationTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationTranslationSeeder extends Seeder
{

    public function run(): void
    {

        LocationTranslation::unguard();
        $tablePath = public_path('db/location_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
