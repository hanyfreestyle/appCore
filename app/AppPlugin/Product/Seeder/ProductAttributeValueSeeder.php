<?php

namespace App\AppPlugin\Product\Seeder;



use App\AppPlugin\Product\Models\AttributeValue;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeValueSeeder extends Seeder {

    public function run(): void {

        AttributeValue::unguard();
        $tablePath = public_path('db/pro_attribute_values.sql');
        DB::unprepared(file_get_contents($tablePath));

        AttributeValue::unguard();
        $tablePath = public_path('db/pro_attribute_value_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
