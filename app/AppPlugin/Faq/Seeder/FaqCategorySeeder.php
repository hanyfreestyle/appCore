<?php

namespace App\AppPlugin\Faq\Seeder;

use App\AppPlugin\Faq\Models\FaqCategory;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqCategorySeeder extends Seeder {

    public function run(): void {

        $newData = 0;
        if($newData == 0) {
            FaqCategory::unguard();
            $tablePath = public_path('db/faq_categories.sql');
            DB::unprepared(file_get_contents($tablePath));
        } else {
            for ($i = 0; $i < 30; $i++) {
                $faker = Factory::create();
                FaqCategory::create([
                    'parent_id' => null,
                    'deep' => 0,
                    'is_active' => 1,
                ]);
            }
        }

    }
}
