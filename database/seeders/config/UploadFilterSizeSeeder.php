<?php

namespace Database\Seeders\config;

use App\Models\admin\config\UploadFilterSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UploadFilterSizeSeeder extends Seeder
{

    public function run(): void
    {

        UploadFilterSize::unguard();
        $tablePath = public_path('db/config_upload_filter_sizes.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
