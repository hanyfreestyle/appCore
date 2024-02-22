<?php

namespace Database\Seeders\admin;


use App\Models\admin\ListingPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListingPhotoSeeder extends Seeder
{

    public function run(): void
    {
        ListingPhoto::unguard();
        $tablePath = public_path('db/listing_photos.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
