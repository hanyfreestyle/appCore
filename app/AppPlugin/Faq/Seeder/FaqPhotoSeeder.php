<?php

namespace App\AppPlugin\Faq\Seeder;

use App\AppPlugin\Faq\Models\FaqPhoto;
use App\AppPlugin\Faq\Models\FaqPhotoTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqPhotoSeeder extends Seeder {

    public function run(): void {
        FaqPhoto::unguard();
        $tablePath = public_path('db/faq_photos.sql');
        DB::unprepared(file_get_contents($tablePath));

        FaqPhotoTranslation::unguard();
        $tablePath = public_path('db/faq_photo_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
