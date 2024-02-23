<?php
namespace App\Http\Controllers\data;

use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\data\CountryRequest;
use App\Http\Traits\CrudTraits;
use App\Models\data\Country;
use App\Models\data\CountryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CountryController extends AdminMainController{
     use CrudTraits;

    function __construct(Country $model){
        parent::__construct();
        $this->controllerName = "Country";
        $this->PrefixRole = 'data';
        $this->selMenu = "data.";
        $this->PrefixCatRoute = "";
        $this->PageTitle =  __('admin/data/country.menu');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;
        $this->UploadDirIs = 'UploadDirIs' ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddConfig'=> true ,
            'configArr'=> ["filterid"=>0],
            'restore'=> 1 ,
            'formName'=> "CountryFilter" ,
        ];
        self::loadConstructData($sendArr);

        $this->middleware('permission:country_view', ['only' => ['index']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('CashCountryList');
        Cache::forget('CashOnlyCountries');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(Request $request){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Country::onlyTrashed()->count();
        $session = self::getSessionData($request);

        if($session == null){
            $rowData = self::getSelectQuery(Country::query());
        }else{
            $rowData = self::getSelectQuery(self::FilterQ(Country::query(),$session));
        }

        return view('admin.data.country.index',compact('pageData','rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $rowData = self::getSelectQuery(Country::onlyTrashed());
        return view('admin.data.country.index',compact('pageData','rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = Country::findOrNew(0);
        return view('admin.data.country.form',compact('pageData','rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = Country::where('id','=',$id)->firstOrFail();
        return view('admin.data.country.form',compact('pageData','rowData'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(CountryRequest $request, $id=0){

        try{
            DB::transaction(function () use ($request,$id){

                $saveData =  Country::findOrNew($id);
                $saveData->iso2 =strtoupper($request->input('iso2'));
                $saveData->iso3 =strtoupper($request->input('iso3'));
                $saveData->fips =strtoupper($request->input('fips'));
                $saveData->iso_numeric =$request->input('iso_numeric');
                $saveData->phone = $request->input('phone');
                $saveData->symbol = $request->input('symbol');
                $saveData->currency_code =strtoupper($request->input('currency_code'));
                $saveData->continent_code =strtoupper($request->input('continent_code'));
                $saveData->language_codes = $request->input('language_codes');
                $saveData->top_level_domain = $request->input('top_level_domain');
                $saveData->time_zone = $request->input('time_zone');
                $saveData->area_km = $request->input('area_km');
                $saveData->save();

               foreach ( config('app.admin_lang') as $key=>$lang) {
                    $saveTranslation = CountryTranslation::where('country_id',$saveData->id)->where('locale',$key)->firstOrNew();
                    $saveTranslation->name = $request->input($key.'.name');
                    $saveTranslation->capital = $request->input($key.'.capital');
                    $saveTranslation->currency = $request->input($key.'.currency');
                    $saveTranslation->continent = $request->input($key.'.continent');
                    $saveTranslation->nationality = $request->input($key.'.nationality');
                    $saveTranslation->save();
                }
            });


        }catch (\Exception $exception){
            return back()->with('data_not_save',"");
        }
        self::ClearCash();
        return  self::redirectWhere($request,$id,$this->PrefixRoute.'.index');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDelete
    public function ForceDelete($id){
        $deleteRow =  Country::onlyTrashed()->where('id',$id)->firstOrFail();
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  updateStatus
    public function updateStatus(Request $request ){
        $thisId  = $request->send_id;
        $updateData = Country::findOrFail($thisId);
        if($updateData->is_active == '1'){
            $updateData->is_active = '0';
        }else{
            $updateData->is_active = '1';
        }
        $updateData->save();
        self::ClearCash();
        return response()->json(['success'=>$thisId]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function printName(){
        $Countries =Country::take(900)->get();
        $line = "[ ";
        foreach ($Countries as $country){
            $line .= "[ ";
            $line .= '"'.$country->name.'", "'.strtolower($country->iso2).'", "'.$country->phone.'"';
            if($Countries->last() == $country) {
                $line .= "]";
            }else{
                $line .= " ],";
            }
        }
        $line .= " ]";
        return echobr($line);
    }


}


