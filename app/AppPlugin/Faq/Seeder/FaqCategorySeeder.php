<?php

namespace App\AppPlugin\Faq\Seeder;

use App\AppPlugin\Faq\Models\FaqCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqCategorySeeder extends Seeder {

    public function run(): void {
        FaqCategory::unguard();
        $tablePath = public_path('db/faq_categories.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
