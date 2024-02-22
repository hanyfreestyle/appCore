<?php

namespace App\Http\Controllers\web;


use App\Http\Controllers\WebMainController;
use App\Models\admin\Listing;
use App\Models\admin\Location;
use Illuminate\Support\Facades\File;


class ProjectViewController extends WebMainController{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ListView
    public function ListView($listingid){

        $description = null;
        $youtube = null;
        $amenities = null;

        $old_slider = [];

        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'HomePage' ;
        $pageView['show_fix'] = false ;


        try {
            $unit= Listing::def()
                ->where('slug',$listingid)
                ->with('developerName')
                ->withCount('slider')
                ->with('slider')
                ->withCount('faqs')
                ->with('faqs')
                ->with('projectName')
                ->firstOrFail();
        }
        catch (\Exception $e){
            self::abortError404('Listing');
        }


        $trees = Location::find($unit->location_id)->ancestorsAndSelf()->orderBy('depth','asc')->get() ;

        if(count($unit->translations) == 1){
            $pageView['go_home'] = route('page_index') ;
        }

        parent::printSeoMeta($unit,'page_ListView');

        if($unit->slider_active == 1){
            $folderPath = public_path("ckfinder/userfiles/".$unit->slider_images_dir);
            if(File::isDirectory($folderPath)){
                $old_slider = File::files($folderPath);
            }else{
                $old_slider = [];
            }
        }

        if($unit->listing_type == 'Project'){
            $description = __('web/compound.listview_h2_des');
            $youtube = $unit->youtube_url;
            $amenities = $unit->amenity;
        }elseif ($unit->listing_type == 'ForSale'){
            $description = __('web/compound.listview_h2_des');
            $youtube = $unit->youtube_url;
            $amenities = $unit->amenity;

        }elseif ($unit->listing_type == 'Unit'){

            $description ="";
            if($unit->youtube_url == null and $unit->projectName->youtube_url != null){
                $youtube = $unit->projectName->youtube_url ;
            }
            if($unit->amenity == null ){
                $amenities = $unit->projectName->amenity;
            }

        }


       return view('web.listing_view')->with(
            [
                'pageView'=>$pageView,
                'unit'=>$unit,
                'old_slider'=>$old_slider,
                'description'=>$description,
                'youtube'=>$youtube,
                'amenities'=>$amenities,
                'trees'=>$trees,
            ]
        );
    }

}
