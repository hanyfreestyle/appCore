<?php

namespace Database\Seeders\config;

use App\AppPlugin\ConfigMeta\MetaTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaTagSeeder extends Seeder
{

    public function run(): void{

        MetaTag::unguard();
        $tablePath = public_path('db/config_meta_tags.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
