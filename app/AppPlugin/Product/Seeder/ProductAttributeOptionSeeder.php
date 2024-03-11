<?php

namespace App\AppPlugin\Product\Seeder;


use App\AppPlugin\Product\Models\ProductAttributeOption;
use App\AppPlugin\Product\Models\ProductAttributeOptionTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeOptionSeeder extends Seeder {

    public function run(): void {

        ProductAttributeOption::unguard();
        $tablePath = public_path('db/pro_attribute_options.sql');
        DB::unprepared(file_get_contents($tablePath));

        ProductAttributeOptionTranslation::unguard();
        $tablePath = public_path('db/pro_attribute_option_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
