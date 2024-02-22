<?php

namespace Database\Seeders\config;

use App\Models\admin\config\MetaTagTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaTagTranslationsTableSeeder extends Seeder
{

    public function run(): void
    {
        MetaTagTranslation::unguard();
        $tablePath = public_path('db/meta_tag_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
