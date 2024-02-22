<?php

namespace App\Http\Controllers;

use App\Models\admin\Amenity;
use App\Models\admin\Category;

use App\Models\admin\config\DefPhoto;
use App\Models\admin\config\MetaTag;
use App\Models\admin\config\Setting;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Location;
use App\Models\admin\Page;

use App\Models\data\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class DefaultMainController extends Controller{

    public $ProjectType_Arr ;
    public $Property_TypeArr ;

    public function __construct(){

        $Property_TypeArr = [
            "1"=> ['id'=>'apartment','name'=> __('web/var.units_apartment')  ],
            "2"=> ['id'=>'duplex','name'=>  __('web/var.units_duplex') ],
            "3"=> ['id'=>'studio','name'=> __('web/var.units_studio')],
            "4"=> ['id'=>'town-house','name'=>  __('web/var.units_town_house') ],
            "5"=> ['id'=>'twin-house','name'=>  __('web/var.units_twin_house')],
            "6"=> ['id'=>'pent-house','name'=> __('web/var.units_pent_house') ],
            "7"=> ['id'=>'villa','name'=>  __('web/var.units_villa')  ],
            "8"=> ['id'=>'office','name'=>  __('web/var.units_office') ],
            "9"=> ['id'=>'store','name'=> __('web/var.units_store') ],
            "10"=> ['id'=>'chalet','name'=>  __('web/var.units_chalet') ],
            "11"=> ['id'=>'chalet-with-garden','name'=> __('web/var.units_chalet_with_garden')],
            "12"=> ['id'=>'pharmacy','name'=> __('web/var.units_pharmacy') ],
            "13"=> ['id'=>'clinic','name'=>  __('web/var.units_clinic') ],
            "14"=> ['id'=>'laboratory','name'=>  __('web/var.units_laboratory')],
        ];
        $this->Property_TypeArr = $Property_TypeArr ;
        View::share('Property_TypeArr', $Property_TypeArr);

        $ListingView_Arr = [
            "1"=> ['id'=>'main-street','name'=> 'Main Street' ],
            "2"=> ['id'=>'seaview','name'=> 'Seaview' ],
            "3"=> ['id'=>'lakeview','name'=> 'Lakeview' ],
            "4"=> ['id'=>'nileview','name'=> 'Nileview' ],
        ];
        View::share('ListingView_Arr', $ListingView_Arr);

        $UnitSatues_Arr = [
            "1"=> ['id'=>'1','name'=> 'Primary' ],
            "2"=> ['id'=>'2','name'=> 'Reseller' ],
        ];
        View::share('UnitSatues_Arr', $UnitSatues_Arr);

        $ProjectSatues_Arr = [
            "1"=> ['id'=>'under-construction','name'=> 'Under Construction' ],
            "2"=> ['id'=>'completed','name'=> 'Completed' ],
        ];
        View::share('ProjectSatues_Arr', $ProjectSatues_Arr);

        $ProjectType_Arr = [
            "1"=> ['id'=>'residential','name'=> __('web/var.project_residential') ],
            "2"=> ['id'=>'vacation','name'=>  __('web/var.project_vacation') ],
            "3"=> ['id'=>'commercial','name'=>  __('web/var.project_commercial') ],
            "4"=> ['id'=>'medical','name'=> __('web/var.project_medical') ],
        ];
        $this->ProjectType_Arr = $ProjectType_Arr ;
        View::share('ProjectType_Arr', $ProjectType_Arr);

        $Bedrooms_Arr = [
            "1"=> ['id'=>'1','name'=> '1' ],
            "2"=> ['id'=>'2','name'=> '2' ],
            "3"=> ['id'=>'3','name'=> '3' ],
            "4"=> ['id'=>'4','name'=> '4' ],
            "5"=> ['id'=>'5','name'=> '5' ],
        ];
        $this->Bedrooms_Arr = $Bedrooms_Arr ;
        View::share('Bedrooms_Arr', $Bedrooms_Arr);


        $Area_Arr = [
            "1"=> ['id'=>'50','name'=> '50' ],
            "2"=> ['id'=>'75','name'=> '75' ],
            "3"=> ['id'=>'125','name'=> '125' ],
            "4"=> ['id'=>'150','name'=> '150' ],
            "5"=> ['id'=>'175','name'=> '175' ],
            "6"=> ['id'=>'200','name'=> '200' ],
            "7"=> ['id'=>'250','name'=> '250' ],
            "8"=> ['id'=>'300','name'=> '300' ],
            "9"=> ['id'=>'400','name'=> '400' ],
            "10"=> ['id'=>'500','name'=> '500' ],
        ];
        $this->Area_Arr = $Area_Arr ;
        View::share('Area_Arr',  $this->Area_Arr);

        $Price_Arr = [
            "1"=> ['id'=>'1000000','name'=> number_format(1000000) ],
            "2"=> ['id'=>'1500000','name'=> number_format(1500000) ],
            "3"=> ['id'=>'2000000','name'=> number_format(2000000) ],
            "4"=> ['id'=>'2500000','name'=> number_format(2500000) ],
            "5"=> ['id'=>'3000000','name'=> number_format(3000000) ],
            "6"=> ['id'=>'3500000','name'=> number_format(3500000) ],
            "7"=> ['id'=>'4000000','name'=> number_format(4000000) ],
            "8"=> ['id'=>'4500000','name'=> number_format(4500000) ],
            "9"=> ['id'=>'5000000','name'=> number_format(5000000) ],
        ];
        $this->Price_Arr = $Price_Arr ;
        View::share('Price_Arr', $this->Price_Arr);


        $MeetingTime_Arr = [
            "1"=> ['id'=>'10:00 AM','name'=> '10:00 AM' ],
            "2"=> ['id'=>'10:30 AM','name'=> '10:30 AM' ],
            "3"=> ['id'=>'11:00 AM','name'=> '11:00 AM' ],
            "4"=> ['id'=>'11:30 AM','name'=> '11:30 AM' ],
            "5"=> ['id'=>'12:00 PM','name'=> '12:00 PM' ],
            "6"=> ['id'=>'12:30 PM','name'=> '12:30 PM' ],
            "7"=> ['id'=>'01:00 PM','name'=> '01:00 PM' ],
            "8"=> ['id'=>'01:30 PM','name'=> '01:30 PM' ],
            "9"=> ['id'=>'02:00 PM','name'=> '02:00 PM' ],
            "10"=> ['id'=>'02:30 PM','name'=> '02:30 PM' ],
            "11"=> ['id'=>'03:00 PM','name'=> '03:00 PM' ],
            "12"=> ['id'=>'03:30 PM','name'=> '03:30 PM' ],
            "13"=> ['id'=>'04:00 PM','name'=> '04:00 PM' ],
            "14"=> ['id'=>'04:30 PM','name'=> '04:30 PM' ],
            "15"=> ['id'=>'05:00 PM','name'=> '05:00 PM' ],
        ];
        View::share('MeetingTime_Arr', $MeetingTime_Arr);


        $Continent_Arr = [
            "1"=> ['id'=>'AS','name'=> __('admin/data/country.continent_as') ],
            "2"=> ['id'=>'EU','name'=> __('admin/data/country.continent_eu') ],
            "3"=> ['id'=>'AF','name'=> __('admin/data/country.continent_af') ],
            "4"=> ['id'=>'OC','name'=> __('admin/data/country.continent_oc')],
            "5"=> ['id'=>'NA','name'=> __('admin/data/country.continent_na') ],
            "6"=> ['id'=>'AN','name'=> __('admin/data/country.continent_an') ],
            "7"=> ['id'=>'SA','name'=> __('admin/data/country.continent_sa') ],
        ];
        View::share('Continent_Arr', $Continent_Arr);


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashLocationList
    static function CashLocationList($stopCash=0){
        if($stopCash){
            $CashLocationList = Location::CashLocationList();
        }else{
            $CashLocationList = Cache::remember('CashLocationList',cashDay(7), function (){
                return  Location::CashLocationList();
            });
        }
        return $CashLocationList ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashDeveloperList
    static function CashDeveloperList($stopCash=0){
        if($stopCash){
            $CashDeveloperList =  Developer::CashDeveloperList();
        }else{
            $CashDeveloperList = Cache::remember('CashDeveloperList',cashDay(7), function (){
                return   Developer::CashDeveloperList();
            });
        }
        return $CashDeveloperList ;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashAmenityList
    static function CashAmenityList($stopCash=0){
        if($stopCash){
            $CashAmenityList =  Amenity::CashAmenityList();
        }else{
            $CashAmenityList = Cache::remember('CashAmenityList',cashDay(7), function (){
                return Amenity::CashAmenityList();
            });
        }
        return $CashAmenityList ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashPagesList
    static function CashPagesList($stopCash=0){
        if($stopCash){
            $CashPagesData = Page::CashPagesList();
        }else{
            $CashPagesData = Cache::remember('CashPagesList',cashDay(7), function (){
                return  Page::CashPagesList();
            });
        }
        return $CashPagesData ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCompoundList
    static function CashCompoundList($stopCash=0){
        if($stopCash){
            $CashCompoundList = Listing::where('listing_type','Project')->CashCompoundList();
        }else{
            $CashCompoundList = Cache::remember('CashCompoundList',cashDay(7), function (){
                return    Listing::where('listing_type','Project')->CashCompoundList();
            });
        }
        return $CashCompoundList ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashPostCategoryList
    static function CashPostCategoryList($stopCash=0){
        if($stopCash){
            $CashPostCategoryList = Category::PostCategoryList();
        }else{
            $CashPostCategoryList = Cache::remember('PostCategoryList',cashDay(7), function (){
                return Category::PostCategoryList();
            });
        }
        return $CashPostCategoryList ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCountryList
    static function CashCountryList($stopCash=0){
        if($stopCash){
            $CashCountryList = Country::select('id','iso2')->with('translation')->get();
        }else{
            $CashCountryList = Cache::remember('CashCountryList',cashDay(7), function (){
                return Country::select('id','iso2')->with('translation')->get();
            });
        }
        return $CashCountryList ;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getWebConfig
    static function getWebConfig($stopCash=0){
        if($stopCash){
            $WebConfig = Setting::where('id' , 1)->with('translations')->first();
        }else{
            $WebConfig = Cache::remember('WebConfig_Cash',cashDay(1), function (){
                return  Setting::where('id', 1)->with('translations')->first();
            });
        }
        return $WebConfig ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getDefPhotoList
    static function getDefPhotoList($stopCash=0){
        if($stopCash){
            $DefPhotoList = DefPhoto::get()->keyBy('cat_id');
        }else{
            $DefPhotoList = Cache::remember('DefPhotoList_Cash',cashDay(7), function (){
                return  DefPhoto::get()->keyBy('cat_id');
            });
        }
        return $DefPhotoList ;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getDefPhotoById
    static function getDefPhotoById($cat_id){
        $DefPhoto = self::getDefPhotoList(0);
        if ($DefPhoto->has($cat_id)) {
            return $DefPhoto[$cat_id] ;
        }else{
            return $DefPhoto['dark_logo'] ?? '' ;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getMeatByCatId
    static function getMeatByCatId($cat_id){
        $WebMeta = Cache::remember('WebMeta_Cash',cashDay(7), function (){
            return  MetaTag::with('translation')->get()->keyBy('cat_id');
        });
        if ($WebMeta->has($cat_id)) {
            return $WebMeta[$cat_id] ;
        }else{
            return $WebMeta['home'] ?? '' ;
        }
    }



}
