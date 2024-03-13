<?php

namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\BlogPost\Models\BlogPhoto;
use App\AppPlugin\BlogPost\Models\BlogPhotoTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogPhotoSeeder extends Seeder {

    public function run(): void {

        BlogPhoto::unguard();
        $tablePath = public_path('db/blog_photos.sql');
        DB::unprepared(file_get_contents($tablePath));

        BlogPhotoTranslation::unguard();
        $tablePath = public_path('db/blog_photo_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
