<?php

namespace Database\Seeders\config;


use App\Models\admin\config\SettingTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTranslationsTableSeeder extends Seeder
{

    public function run(): void
    {
        SettingTranslation::unguard();
        $tablePath = public_path('db/config_setting_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
