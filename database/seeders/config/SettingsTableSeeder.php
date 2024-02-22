<?php

namespace Database\Seeders\config;

use App\Models\admin\config\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SettingsTableSeeder extends Seeder
{

    public function run(): void
    {

        Setting::unguard();
        $tablePath = public_path('db/config_settings.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
