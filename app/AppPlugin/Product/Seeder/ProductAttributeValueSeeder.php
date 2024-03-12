<?php

namespace App\AppPlugin\Product\Seeder;



use App\AppPlugin\Product\Models\ProductAttributeValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeValueSeeder extends Seeder {

    public function run(): void {

        ProductAttributeValue::unguard();
        $tablePath = public_path('db/pro_attribute_values.sql');
        DB::unprepared(file_get_contents($tablePath));

        ProductAttributeValue::unguard();
        $tablePath = public_path('db/pro_attribute_value_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
