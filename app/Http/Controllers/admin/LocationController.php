<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\LocationRequest;
use App\Http\Traits\CrudTraits;
use App\Models\admin\Location;
use App\Models\admin\LocationTranslation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class LocationController extends  AdminMainController{

    use CrudTraits;

    function __construct(Location $model){
        parent::__construct();
        $this->controllerName = "location";
        $this->PrefixRole = 'location';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/menu.location') ;
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;
        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddConfig'=> true ,
        ];
        self::loadConstructData($sendArr);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('CashLocationList');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $locations = self::getSelectQuery(Location::query()->with('parentName'));
        return view('admin.location.index',compact('pageData','locations'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $locationList = Location::all();
        $location = Location::findOrNew(0);
        return view('admin.location.form',compact('pageData','location','locationList'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $location = Location::findOrFail($id);
        $locationList = Location::where('id','!=' ,$id)->get();
        return view('admin.location.form',compact('location','pageData','locationList'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(LocationRequest $request, $id=0){
        try{
            DB::transaction(function () use ($request,$id){
                $saveData =  Location::findOrNew($id);
                $saveData->slug = AdminHelper::Url_Slug($request->slug);
                $saveData->is_active = intval((bool) $request->input( 'is_active'));
                $saveData->is_searchable = intval((bool) $request->input( 'is_searchable'));
                $saveData->is_home = intval((bool) $request->input( 'is_home'));
                $saveData->projects_type = $request->projects_type ;
                $saveData->latitude = $request->latitude ;
                $saveData->longitude  = $request->longitude  ;
                $saveData->parent_id  = $request->parent_id  ;

                $saveImgData = new PuzzleUploadProcess();
                $saveImgData->setCountOfUpload('2');
                $saveImgData->setUploadDirIs('location');
                $saveImgData->setnewFileName($request->input('slug'));
                $saveImgData->UploadOne($request);
                $saveData = AdminHelper::saveAndDeletePhoto($saveData,$saveImgData);
                $saveData->save();

                foreach ( config('app.web_lang') as $key=>$lang) {
                    $saveTranslation = LocationTranslation::where('location_id',$saveData->id)->where('locale',$key)->firstOrNew();
                    $saveTranslation->location_id = $saveData->id;
                    $saveTranslation = self::saveTranslationMain($saveTranslation,$key,$request);
                    $saveTranslation->save();
                }
            });
        }catch (\Exception $exception){
            return back()->with('data_not_save',"");
        }
        self::ClearCash();
        return  self::redirectWhere($request,$id,'location.index');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyException($id){

        $deleteRow =  Location::where('id',$id)
            ->withCount('del_locations')
            ->withCount('del_listings')
            ->withCount('del_pages')
            ->withCount('del_posts')
            ->firstOrFail();

        if($deleteRow->del_locations_count == 0 and $deleteRow->del_listings_count == 0
            and $deleteRow->del_pages_count == 0 and $deleteRow->del_posts_count == 0   ){
            try{
                DB::transaction(function () use ($id){
                    $deleteRow = Location::findOrFail($id);
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    $deleteRow->forceDelete();
                });
            }catch (\Exception $exception){
                 return back()->with(['confirmException'=>'','fromModel'=>'Location','deleteRow'=>$deleteRow]);
            }
        }else{
            return back()->with(['confirmException'=>'','fromModel'=>'Location','deleteRow'=>$deleteRow]);
        }

        self::ClearCash();
        return back()->with('confirmDelete',"");
    }


}
