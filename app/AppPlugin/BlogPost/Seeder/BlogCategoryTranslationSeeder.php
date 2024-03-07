<?php

namespace App\AppPlugin\BlogPost\Seeder;



use App\AppPlugin\BlogPost\Models\BlogCategoryTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogCategoryTranslationSeeder extends Seeder {

    public function run(): void {
        BlogCategoryTranslation::unguard();
        $tablePath = public_path('db/blog_category_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
