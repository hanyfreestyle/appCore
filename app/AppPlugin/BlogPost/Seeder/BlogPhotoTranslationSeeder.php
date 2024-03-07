<?php

namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\BlogPost\Models\BlogPhotoTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogPhotoTranslationSeeder extends Seeder {

    public function run(): void {
        BlogPhotoTranslation::unguard();
        $tablePath = public_path('db/blog_photo_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
