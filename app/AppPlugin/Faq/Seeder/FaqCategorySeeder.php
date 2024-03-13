<?php

namespace App\AppPlugin\Faq\Seeder;

use App\AppPlugin\Faq\Models\FaqCategory;
use App\AppPlugin\Faq\Models\FaqCategoryTranslation;
use App\Helpers\AdminHelper;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


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

        if($newData == 0) {
            FaqCategoryTranslation::unguard();
            $tablePath = public_path('db/faq_category_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        } else {
            ini_set('memory_limit', '-1');
            $Category = FaqCategory::all();
            foreach ($Category as $one) {
                foreach (config('app.web_lang') as $key => $lang) {
                    if($key == 'ar') {
                        $faker = Factory::create('ar_EG');
                    } else {
                        $faker = Factory::create('en_US');
                    }
                    $name = $faker->realText('30');
                    $des = $faker->realText('600');
                    FaqCategoryTranslation::create([
                        'category_id' => $one->id,
                        'locale' => $key,
                        'slug' => AdminHelper::Url_Slug($name . " " . $one->id),
                        'name' => $name,
                        'des' => $des,
                        'g_title' => $name,
                        'g_des' => Str::limit($des, 120, ""),
                    ]);
                }
            }
        }

    }
}
