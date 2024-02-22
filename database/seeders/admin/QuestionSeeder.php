<?php

namespace Database\Seeders\admin;


use App\Models\admin\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{

    public function run(): void
    {
        Question::unguard();
        $tablePath = public_path('db/questions.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
