<?php

namespace Database\Seeders\admin;
use App\Models\admin\CategoryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslationSeeder extends Seeder
{

    public function run(): void
    {


        CategoryTranslation::unguard();
        $tablePath = public_path('db/category_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
