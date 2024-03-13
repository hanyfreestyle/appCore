<?php

namespace App\AppPlugin\Faq\Seeder;

use App\AppPlugin\Faq\Models\Faq;
use App\AppPlugin\Faq\Models\FaqCategory;
use App\AppPlugin\Faq\Models\FaqPivot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqPivotSeeder extends Seeder {

    public function run(): void {
        $newData = 0;

        if($newData == 0) {
            FaqPivot::unguard();
            $tablePath = public_path('db/faqcategory_faq.sql');
            DB::unprepared(file_get_contents($tablePath));
        } else {
            $allFaq = Faq::all();
            foreach ($allFaq as $faq) {
                $rand = rand(1, 4);
                $categories = FaqCategory::inRandomOrder()->take($rand)->pluck('id')->toArray();
                $faq->categories()->sync($categories);
                $faq->save();
            }
        }

    }
}
