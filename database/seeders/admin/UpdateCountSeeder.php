<?php

namespace Database\Seeders\admin;

use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateCountSeeder extends Seeder
{

    public function run(): void{

        $Locations = Location::all();

        foreach ($Locations as $Location){

            $projects_count = Listing::where('listing_type','=','Project')
                ->where('is_published', true)
                ->where('location_id',$Location->id)
                ->count();

            $units_count = Listing::where('listing_type','!=','Project')
                ->where('is_published', true)
                ->where('location_id',$Location->id)
                ->count();

            $Location->projects_count = $projects_count;
            $Location->units_count = $units_count;
            $Location->save();

        }


        $Developers = Developer::withTrashed()->get();

        foreach ($Developers as $Developer){
            $projects_count = Listing::where('listing_type','=','Project')
                ->where('is_published', true)
                ->where('developer_id',$Developer->id)
                ->count();


            $units_count = Listing::where('listing_type','!=','Project')
                ->where('is_published', true)
                ->where('developer_id',$Developer->id)
                ->count();

            $Developer->projects_count = $projects_count;
            $Developer->units_count = $units_count;
            $Developer->save();

        }



    }
}
