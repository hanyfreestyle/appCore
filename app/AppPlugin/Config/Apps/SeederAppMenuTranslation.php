<?php

namespace App\AppPlugin\Config\Apps;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederAppMenuTranslation extends Seeder {
  public function run(): void {
    AppMenuTranslation::unguard();
    $tablePath = public_path('db/config_app_menu_translations.sql');
    DB::unprepared(file_get_contents($tablePath));
  }
}
