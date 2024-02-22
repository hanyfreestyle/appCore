<?php

namespace Database\Seeders\data;

use App\Models\data\CountryTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTranslationSeeder extends Seeder{

    public function run(): void{

        CountryTranslation::unguard();
        $tablePath = public_path('db/data_country_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
