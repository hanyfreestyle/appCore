<?php

namespace Database\Seeders\config;

use App\Models\admin\config\Setting;
use App\Models\admin\config\SettingTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder {

    public function run(): void {

        Setting::unguard();
        $tablePath = public_path('db/config_settings.sql');
        DB::unprepared(file_get_contents($tablePath));

        SettingTranslation::unguard();
        $tablePath = public_path('db/config_setting_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
