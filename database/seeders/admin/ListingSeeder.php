<?php

namespace Database\Seeders\admin;

use App\Models\admin\Developer;
use App\Models\admin\Listing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListingSeeder extends Seeder
{


    public function run(): void{


//        $old_listing = DB::connection('mysql2')->table('listings')
//            ->where('deleted_at','!=',null)
//            ->delete();
//
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',194)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',197)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',198)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',206)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',215)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',27399)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',27422)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',27423)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',27424)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',27425)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',27426)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',27427)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',27428)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',27429)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('id',27430)->delete();
//        $old_listing = DB::connection('mysql2')->table('listings')->where('parent_id',27207)->delete();
//
//        set_time_limit(0);
//        ini_set('memory_limit', '512M');
//        $old_listing = DB::connection('mysql2')->table('listings')->limit(500000000000000000)->get();
//        foreach ($old_listing as $oldData){
//            $saveData = new Listing();
//            $saveData->id = $oldData->id ;
//            $saveData->location_id = $oldData->location_id ;
//            $saveData->developer_id = $oldData->developer_id ;
//            $saveData->slug = $oldData->slug ;
//            $saveData->slider_images_dir = $oldData->slider_images_dir ;
//            $saveData->youtube_url = $oldData->youtube_url ;
//            $saveData->price = $oldData->price ;
//            $saveData->area = $oldData->area ;
//            $saveData->baths = $oldData->baths ;
//            $saveData->rooms = $oldData->rooms ;
//            $saveData->status = $oldData->status ;
//            $saveData->project_type = $oldData->project_type ;
//            $saveData->property_type = $oldData->property_type ;
//            $saveData->view = $oldData->view ;
//            $saveData->latitude = $oldData->latitude ;
//            $saveData->longitude = $oldData->longitude ;
//            $saveData->delivery_date = substr($oldData->delivery_date, 0, 4);
//            $saveData->is_published = $oldData->is_published ;
//            $saveData->is_featured = $oldData->is_featured ;
//            $saveData->published_at = $oldData->published_at ;
//            $saveData->created_at = $oldData->created_at ;
//            $saveData->deleted_at = $oldData->deleted_at ;
//            $saveData->updated_at = $oldData->updated_at ;
//
//            if($oldData->property_type != null ){
//                $saveData->unit_status = 1 ;
//            }
//
//            if( $saveData->id ==  $oldData->parent_id   ){
//                $saveData->parent_id = null ;
//            }else{
//                $saveData->parent_id = $oldData->parent_id ;
//            }
//
//            $saveData->save();
//        }

        Listing::unguard();
        $tablePath = public_path('db/listings.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
