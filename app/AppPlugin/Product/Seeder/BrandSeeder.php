<?php

namespace App\AppPlugin\Product\Seeder;


use App\AppPlugin\Product\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder {

    public function run(): void {
        Brand::unguard();
        $tablePath = public_path('db/pro_brands.sql');
        DB::unprepared(file_get_contents($tablePath));
    }

}
