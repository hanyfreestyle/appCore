<?php

namespace App\AppPlugin\Config\Privacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederWebPrivacyTranslation extends Seeder
{

    public function run(): void
    {
        WebPrivacyTranslation::unguard();
        $tablePath = public_path('db/config_web_privacy_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
