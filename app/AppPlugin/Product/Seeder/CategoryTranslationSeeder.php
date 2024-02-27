<?php

namespace App\AppPlugin\Product\Seeder;


use App\AppPlugin\Product\Models\CategoryTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslationSeeder extends Seeder {

    public function run(): void {
        CategoryTranslation::unguard();
        $tablePath = public_path('db/pro_category_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }

}
