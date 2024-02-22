<?php

namespace Database\Seeders\config;

use App\Models\admin\config\UploadFilter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UploadFilterSeeder extends Seeder
{

    public function run(): void
    {
        UploadFilter::unguard();
        $tablePath = public_path('db/config_upload_filters.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
