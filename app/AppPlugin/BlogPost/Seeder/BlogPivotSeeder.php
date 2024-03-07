<?php
namespace App\AppPlugin\BlogPost\Seeder;


use App\AppPlugin\BlogPost\Models\BlogPivot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogPivotSeeder extends Seeder {

    public function run(): void {
        BlogPivot::unguard();
        $tablePath = public_path('db/blogcategory_blog.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
