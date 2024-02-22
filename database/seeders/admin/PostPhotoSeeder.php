<?php

namespace Database\Seeders\admin;

use App\Models\admin\PostPhoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostPhotoSeeder extends Seeder
{

    public function run(): void
    {

        PostPhoto::unguard();
        $tablePath = public_path('db/post_photos.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
