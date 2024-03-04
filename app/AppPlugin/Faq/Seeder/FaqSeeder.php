<?php

namespace App\AppPlugin\Faq\Seeder;


use App\AppPlugin\Faq\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqSeeder extends Seeder {

    public function run(): void {
        Faq::unguard();
        $tablePath = public_path('db/faqs.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
