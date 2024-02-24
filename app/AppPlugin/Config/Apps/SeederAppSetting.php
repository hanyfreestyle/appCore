<?php

namespace App\AppPlugin\Config\Apps;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederAppSetting extends Seeder {

  public function run(): void {
    AppSetting::unguard();
    $tablePath = public_path('db/config_app_settings.sql');
    DB::unprepared(file_get_contents($tablePath));
  }

}
