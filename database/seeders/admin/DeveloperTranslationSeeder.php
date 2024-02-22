<?php

namespace Database\Seeders\admin;

use App\Models\admin\DeveloperTranslation;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DeveloperTranslationSeeder extends Seeder
{

    public function run(): void
    {
        DeveloperTranslation::unguard();
        $tablePath = public_path('db/developer_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }



}
