<?php

namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\Faq\Models\FaqCategoryTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogCategoryTranslationSeeder extends Seeder {

    public function run(): void {
        FaqCategoryTranslation::unguard();
        $tablePath = public_path('db/blog_category_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
