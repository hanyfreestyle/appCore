<?php

namespace Database\Seeders\admin;

use App\Models\admin\Developer;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{

    public function run(): void
    {

        Developer::unguard();
        $tablePath = public_path('db/developers.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
