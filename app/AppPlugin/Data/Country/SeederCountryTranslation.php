<?php

namespace App\AppPlugin\Data\Country;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederCountryTranslation extends Seeder {

  public function run(): void {
    CountryTranslation::unguard();
    $tablePath = public_path('db/data_country_translations.sql');
    DB::unprepared(file_get_contents($tablePath));
  }

}
