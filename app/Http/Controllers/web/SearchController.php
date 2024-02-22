<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\WebMainController;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Location;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;

class SearchController extends WebMainController{


    public $developerName;
    public $locationName;



    public function __construct(
        $developerName = null ,
        $locationName = null ,
    )
    {
        parent::__construct();
        $this->developerName = $developerName ;
        $this->locationName = $locationName ;

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Search
    public function Search(Request $request){

        if(isset($request->project_type)){
            if($request->project_type == 'medical'){
                $Property_TypeArr = [
                    "1"=> ['id'=>'pharmacy','name'=> 'Pharmacy' ],
                    "2"=> ['id'=>'clinic','name'=> 'Clinic' ],
                    "3"=> ['id'=>'laboratory','name'=> 'Laboratory' ],
                ];
                $this->Property_TypeArr = $Property_TypeArr ;
                View::share('Property_TypeArr', $this->Property_TypeArr);
            }
        }


        $projects = self::SearchQuery($request,Listing::WebProjects(),'project')
            ->orderBy('id','desc')
            ->paginate(12, ['*'], 'compound_page')->appends(request()->query()) ;

        $units = self::SearchQuery($request,Listing::WebUnits(),'units')
            ->orderBy('id','desc')
            ->paginate(12, ['*'], 'property_page')->appends(request()->query());


        $setTitle = __('web/search.h_compound')." ";
        if($this->locationName != null){
            $setTitle .= __('web/search.h_in') ." ". $this->locationName ." - ";
        }
        $setTitle .= $projects->total()." ".__('web/compound.h1_compounds')." - ";
        $setTitle .= $units->total()." ".__('web/compound.h1_properties');


        SEOMeta::setTitle($setTitle);
        SEOMeta::setDescription($setTitle);

        $pageView = $this->pageView ;
        $pageView['SelMenu'] = '';


        return view('web.search')->with(
            [
                'pageView'=>$pageView,
                'projects'=>$projects,
                'units'=>$units,
                'setTitle'=>$setTitle,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SearchQuery
    public function SearchQuery(Request $request,$query,$searchType){

        if(isset($request->project_name)){
            $listIdSend = [];

            $Locations = Location::whereTranslationLike('name', '%'.$request->project_name.'%')->pluck('id')->toarray();
            foreach ($Locations as $Location){
                $listId = Location::find($Location)->descendantsAndSelf()->orderBy('depth','asc')->pluck('id')->toarray();
                $listIdSend  =array_merge_recursive($listIdSend,$listId);
            }

            if(count($listIdSend)>0){
                $query->whereIn('location_id',$listIdSend);
            }else{
                $query->WhereTranslationLike('name', '%'.$request->project_name.'%');
            }

        }


        if(isset($request->developer)){
            $developer = Developer::getDeveloperList()->where('slug',$request->developer)->first();
            if($developer != null){
                $query->where('developer_id',$developer->id);
            }
        }

        if(isset($request->location)){
            $location = Location::where('is_active',true)->where('slug',$request->location)->first();
            if($location != null){
                $this->locationName = $location->name;
                $listId = Location::find($location->id)->descendantsAndSelf()->orderBy('depth','asc')->pluck('id')->toarray();
                $query->whereIn('location_id',$listId);
            }
        }
        if(isset($request->project_type)){
            $ProjectTypeList = array_column($this->ProjectType_Arr, 'id');
            if(in_array($request->project_type,$ProjectTypeList)){
                if($searchType == 'project'){
                    $query->where('project_type',$request->project_type);
                }
                if($searchType == 'units'){
                    if(!isset($request->property_type)){
                        $query->whereHas('projectName', function($q) use ($request){
                            $q->where('project_type', '=', $request->project_type);
                        });
                    }
                }
            }
        }

        if(isset($request->property_type)){
            $PropertyTypeList = array_column($this->Property_TypeArr, 'id');
            if(in_array($request->property_type,$PropertyTypeList)){
                if($searchType == 'units'){
                    $query->where('property_type',$request->property_type);
                }
            }
        }

        if(isset($request->rooms)){
            $roomsList = array_column($this->Bedrooms_Arr, 'id');
            if(in_array($request->rooms,$roomsList)){
                if($searchType == 'units'){
                    $query->where('rooms',$request->rooms);
                }
            }
        }

        if(isset($request->baths)){
            $bathsList = array_column($this->Bedrooms_Arr, 'id');
            if(in_array($request->baths,$bathsList)){
                if($searchType == 'units'){
                    $query->where('baths',$request->baths);
                }
            }
        }

        if(isset($request->min_area)){
            $AreaList = array_column($this->Area_Arr, 'id');
            if(in_array($request->min_area,$AreaList)){
                if($searchType == 'units'){
                    $query->where('area','>=',$request->min_area);
                }
            }
        }

        if(isset($request->max_area)){
            $AreaList = array_column($this->Area_Arr, 'id');
            if(in_array($request->max_area,$AreaList)){
                if($searchType == 'units'){
                    $query->where('area','<=',$request->max_area);
                }
            }
        }


        if(isset($request->min_price)){
            $PriceList = array_column($this->Price_Arr, 'id');
            if(in_array($request->min_price,$PriceList)){
                $query->where('price','>=',$request->min_price);
            }
        }

        if(isset($request->max_price)){
            $PriceList = array_column($this->Price_Arr, 'id');
            if(in_array($request->max_price,$PriceList)){
                $query->where('price','<=',$request->max_price);
            }
        }

        return $query;
    }


}
