<?php

namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\Faq\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogSeeder extends Seeder {

    public function run(): void {
        Faq::unguard();
        $tablePath = public_path('db/blog_post.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
