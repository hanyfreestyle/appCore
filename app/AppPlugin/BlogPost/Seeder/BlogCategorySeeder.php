<?php

namespace App\AppPlugin\BlogPost\Seeder;

use App\AppPlugin\Faq\Models\FaqCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogCategorySeeder extends Seeder {

    public function run(): void {
        FaqCategory::unguard();
        $tablePath = public_path('db/blog_categories.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
