<?php

namespace App\AppPlugin\Product\Seeder;

use App\AppPlugin\Product\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder {

    public function run(): void {
        Category::unguard();
        $tablePath = public_path('db/pro_categories.sql');
        DB::unprepared(file_get_contents($tablePath));
    }

}
