<?php

namespace App\AppPlugin\BlogPost\Seeder;



use App\AppPlugin\BlogPost\Models\BlogTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogTranslationSeeder extends Seeder {

    public function run(): void {
        BlogTranslation::unguard();
        $tablePath = public_path('db/blog_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
