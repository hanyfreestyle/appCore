<?php

namespace App\AppPlugin\BlogPost\Seeder;



use App\AppPlugin\Faq\Models\FaqPhotoTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogPhotoTranslationSeeder extends Seeder {

    public function run(): void {
        FaqPhotoTranslation::unguard();
        $tablePath = public_path('db/blog_photo_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
