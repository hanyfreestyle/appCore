<?php

namespace App\AppPlugin\Product\Seeder;


use App\AppPlugin\Product\Models\ProductTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTranslationSeeder extends Seeder {

    public function run(): void {

        ProductTranslation::unguard();
        $tablePath = public_path('db/pro_product_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
