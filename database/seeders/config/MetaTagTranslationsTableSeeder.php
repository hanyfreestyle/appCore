<?php

namespace Database\Seeders\config;


use App\AppPlugin\ConfigMeta\MetaTagTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaTagTranslationsTableSeeder extends Seeder
{

    public function run(): void{
        MetaTagTranslation::unguard();
        $tablePath = public_path('db/config_meta_tag_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
