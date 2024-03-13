<?php

namespace App\AppPlugin\Product\Seeder;

use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\CategoryTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder {

    public function run(): void {
        Category::unguard();
        $tablePath = public_path('db/pro_categories.sql');
        DB::unprepared(file_get_contents($tablePath));

        CategoryTranslation::unguard();
        $tablePath = public_path('db/pro_category_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
