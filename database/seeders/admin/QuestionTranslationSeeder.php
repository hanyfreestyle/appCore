<?php

namespace Database\Seeders\admin;

use App\Models\admin\QuestionTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTranslationSeeder extends Seeder
{

    public function run(): void
    {
        QuestionTranslation::unguard();
        $tablePath = public_path('db/question_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
