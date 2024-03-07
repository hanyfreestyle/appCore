<?php

namespace App\AppPlugin\BlogPost\Seeder;



use App\AppPlugin\BlogPost\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogCategorySeeder extends Seeder {

    public function run(): void {
        BlogCategory::unguard();
        $tablePath = public_path('db/blog_categories.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
