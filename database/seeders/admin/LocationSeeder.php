<?php

namespace Database\Seeders\admin;

use App\Models\admin\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{

    public function run(): void
    {



//        Location::unguard();
//        $tablePath = public_path('db/locations.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        $location = Location::findOrFail(4);
//        $location->parent_id = 7 ;
//        $location->save();
//
//        $location = Location::findOrFail(5);
//        $location->parent_id = 7 ;
//        $location->save();


        Location::unguard();
        $tablePath = public_path('db/locations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
