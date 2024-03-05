<?php

namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\Faq\Models\FaqTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogTranslationSeeder extends Seeder {

    public function run(): void {
        FaqTranslation::unguard();
        $tablePath = public_path('db/blog_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
