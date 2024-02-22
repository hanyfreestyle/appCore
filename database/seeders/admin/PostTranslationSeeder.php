<?php

namespace Database\Seeders\admin;

use App\Models\admin\PostTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTranslationSeeder extends Seeder
{

    public function run(): void
    {

        PostTranslation::unguard();
        $tablePath = public_path('db/post_translations.sql');
        DB::unprepared(file_get_contents($tablePath));


        $updatePost = PostTranslation::where('name',null)->get();
        foreach ($updatePost as $post){
            $post->delete();
        }

    }
}
