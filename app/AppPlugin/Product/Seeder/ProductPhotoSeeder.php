<?php

namespace App\AppPlugin\Product\Seeder;

use App\AppPlugin\Product\Models\ProductPhoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPhotoSeeder extends Seeder {

    public function run(): void {
        ProductPhoto::unguard();
        $tablePath = public_path('db/pro_product_photos.sql');
        DB::unprepared(file_get_contents($tablePath));
    }

}
