<?php

namespace Database\Seeders\admin;

use App\Models\admin\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{

    public function run(): void
    {

        Post::unguard();
        $tablePath = public_path('db/posts.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
