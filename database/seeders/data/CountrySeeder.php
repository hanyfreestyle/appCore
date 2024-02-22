<?php

namespace Database\Seeders\data;

use App\Models\data\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder{

    public function run(): void{

        Country::unguard();
        $tablePath = public_path('db/data_countries.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
