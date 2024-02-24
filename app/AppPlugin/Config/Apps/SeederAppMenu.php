<?php

namespace App\AppPlugin\Config\Apps;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederAppMenu extends Seeder{

    public function run(): void
    {
        AppMenu::unguard();
        $tablePath = public_path('db/config_app_menus.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
