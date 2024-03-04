<?php

namespace App\AppPlugin\Faq\Seeder;


use App\AppPlugin\Faq\Models\FaqCategoryTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqCategoryTranslationSeeder extends Seeder {

    public function run(): void {
        FaqCategoryTranslation::unguard();
        $tablePath = public_path('db/faq_category_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
