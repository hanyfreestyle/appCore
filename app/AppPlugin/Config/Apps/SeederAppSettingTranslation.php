<?php

namespace App\AppPlugin\Config\Apps;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederAppSettingTranslation extends Seeder {

  public function run(): void {
    AppSettingTranslation::unguard();
    $tablePath = public_path('db/config_app_setting_translations.sql');
    DB::unprepared(file_get_contents($tablePath));
  }

}
