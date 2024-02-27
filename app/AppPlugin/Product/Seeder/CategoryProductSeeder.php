<?php

namespace App\AppPlugin\Product\Seeder;

use App\AppPlugin\Product\Models\CategoryProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoryProductSeeder extends Seeder {
    public function run(): void {
        CategoryProduct::unguard();
        $tablePath = public_path('db/pro_category_product.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
