<?php

namespace App\AppPlugin\Product\Seeder;


use App\AppPlugin\Product\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {

    public function run(): void {
        Product::unguard();
        $tablePath = public_path('db/pro_products.sql');
        DB::unprepared(file_get_contents($tablePath));
    }

}
