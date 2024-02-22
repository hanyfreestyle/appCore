<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminMainController;
use App\Models\admin\config\Setting;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;


class UpdateDataController extends AdminMainController{

    function __construct(){

        parent::__construct();
        $this->controllerName = "config";
        $this->PrefixRole = 'config';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/cash.app_menu');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddButToCard'=> false ,
        ];
        self::loadConstructData($sendArr);
        $this->middleware('permission:config_website', ['only' => ['webConfigEdit','webConfigUpdate']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function index(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $setting = Setting::findOrFail(1);

        $CashKey = ['CashLocationList','CashDeveloperList','CashAmenityList','CashPagesList','CashCompoundList','PostCategoryList'];
        $KeyCount = 0 ;
        foreach ($CashKey as $key){
            if(Cache::get($key) != null){
                $KeyCount = $KeyCount+1;
            }
        }
        return view('admin.updateData.index')->with(compact('pageData','setting','KeyCount','setting'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ClearKey
    public function ClearKey(Request $request){
        Cache::forget($request->input('key'));
        return back()->with('confirmDelete',"");
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ClearKey
    public function ClearAll(Request $request){
        Artisan::call('optimize:clear');
        return back()->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DBDeveloper
    public function DBDeveloper(){
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

        $setting = Setting::findOrFail(1);
        $setting->developer_update = now();
        $setting->save();
        return back()->with('DbUpdate.Done',"");

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # DBLocation
    public function DBLocation(){
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

        $setting = Setting::findOrFail(1);
        $setting->location_update = now();
        $setting->save();
        return back()->with('DbUpdate.Done',"");

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DBProject
    public function DBProject(){
        $Projects =  Listing::project()->withCount('web_units')->get();
        foreach ($Projects as $project){
            $project->units_count = $project->web_units_count ;
            $project->save() ;
        }
        $setting = Setting::findOrFail(1);
        $setting->project_update = now();
        $setting->save();
        return back()->with('DbUpdate.Done',"");
    }

}
