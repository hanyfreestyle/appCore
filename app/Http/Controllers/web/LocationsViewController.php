<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\WebMainController;
use App\Models\admin\Listing;
use App\Models\admin\Location;


class LocationsViewController extends WebMainController {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     LocationView
    public function LocationView($slug){

        try {
            $location = Location::query()
                ->where('is_active',true)
                ->where('slug',$slug)
                ->firstOrFail();
        }
        catch (\Exception $e){
            self::abortError404('root');
        }

        parent::printSeoMeta($location,'page_locationView');
        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'Compounds' ;

        $trees = Location::find($location->id)->ancestorsAndSelf()->orderBy('depth','asc')->get() ;

        $listId = Location::find($location->id)->descendantsAndSelf()->orderBy('depth','asc')
            ->pluck('id');


        $projects = Listing::def()
            ->where('listing_type','Project')
            ->whereIn('location_id',$listId)
            ->with('developerName')
            ->orderBy('id','desc')
            ->paginate(12, ['*'], 'compound_page');

        if ($projects->isEmpty()) {
            self::abortError404('Empty');
        }


        $units= Listing::def()
            ->where('listing_type','!=','Project')
            ->whereIn('location_id',$listId)
            ->with('developerName')
            ->orderBy('id','desc')
            ->paginate(12, ['*'], 'property_page');



        if ($units->isEmpty()) {
            self::abortError404('Empty');
        }

        return view('web.location_view')->with(
            [
                'pageView'=>$pageView,
                'projects'=>$projects,
                'units'=>$units,
                'trees'=>$trees,
                'location'=>$location,
            ]
        );

    }


}
