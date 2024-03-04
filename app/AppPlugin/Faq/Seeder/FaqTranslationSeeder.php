<?php

namespace App\AppPlugin\Faq\Seeder;


use App\AppPlugin\Faq\Models\FaqTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqTranslationSeeder extends Seeder {

    public function run(): void {
        FaqTranslation::unguard();
        $tablePath = public_path('db/faq_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
