<?php
namespace App\AppPlugin\Faq\Seeder;

use App\AppPlugin\Faq\Models\FaqPivot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqPivotSeeder extends Seeder {

    public function run(): void {
        FaqPivot::unguard();
        $tablePath = public_path('db/faqcategory_faq.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
