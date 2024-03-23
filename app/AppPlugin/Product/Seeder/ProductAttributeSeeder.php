<?php

namespace App\AppPlugin\Product\Seeder;




use App\AppPlugin\Product\Models\Attribute;
use App\AppPlugin\Product\Models\AttributeTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeSeeder extends Seeder {

    public function run(): void {

        Attribute::unguard();
        $tablePath = public_path('db/pro_attributes.sql');
        DB::unprepared(file_get_contents($tablePath));

        AttributeTranslation::unguard();
        $tablePath = public_path('db/pro_attribute_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
