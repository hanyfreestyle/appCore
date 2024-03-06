<?php

namespace App\AppPlugin\Faq\Seeder;


use App\AppPlugin\Faq\Models\Faq;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqSeeder extends Seeder {

    public function run(): void {

        $newData = 0;
        if($newData == 0) {
            Faq::unguard();
            $tablePath = public_path('db/faq_faqs.sql');
            DB::unprepared(file_get_contents($tablePath));
        }else{
            for ($i = 0; $i < 100; $i++) {
                $faker = Factory::create();
                Faq::create([
                    'is_active' => 1,
                ]);
            }
        }



    }
}
