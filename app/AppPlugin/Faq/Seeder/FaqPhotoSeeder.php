<?php

namespace App\AppPlugin\Faq\Seeder;

use App\AppPlugin\Faq\Models\FaqPhoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqPhotoSeeder extends Seeder {
    public function run(): void {
        FaqPhoto::unguard();
        $tablePath = public_path('db/faq_photos.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
