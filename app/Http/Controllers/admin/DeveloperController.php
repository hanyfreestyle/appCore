<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\DeveloperRequest;
use App\Http\Traits\CrudTraits;
use App\Models\admin\Developer;
use App\Models\admin\DeveloperPhoto;
use App\Models\admin\DeveloperTranslation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class DeveloperController extends AdminMainController{
    use CrudTraits;

    function __construct(Developer $model,DeveloperPhoto $modelPhoto ){

        parent::__construct();
        $this->controllerName = "developer";
        $this->PrefixRole = 'developer';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/menu.developer');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;
        $this->modelPhoto = $modelPhoto ;
        $this->modelPhotoColumn = 'developer_id' ;
        $this->UploadDirIs = 'developer' ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddConfig'=> true ,
            'yajraTable'=> true ,
            'configArr'=> ["morePhotoFilterid"=>1],
        ];

        self::loadConstructData($sendArr);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('CashDeveloperList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Developer::onlyTrashed()->count();

        if ($this->viewDataTable and $this->yajraTable){
            return view('admin.developer.index_DataTable',compact('pageData'));
        }else{
            $Developers = self::getSelectQuery(Developer::withCount('admin_more_photos'));
            return view('admin.developer.index',compact('pageData','Developers'));
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function DataTable(Request $request){
        if ($request->ajax()) {
            $data = Developer::select(
                ['developers.id','photo_thum_1','is_active','projects_count','units_count']
            )->with('tablename');
             return self::DataTableAddColumns($data)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $Developer = Developer::findOrNew(0);
        return view('admin.developer.form',compact('pageData','Developer'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $Developer = Developer::findOrFail($id);
        return view('admin.developer.form',compact('Developer','pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(DeveloperRequest $request, $id=0){
        try{
            DB::transaction(function () use ($request,$id){
                $saveData =  Developer::findOrNew($id);
                $saveData->slug = AdminHelper::Url_Slug($request->slug);
                $saveData->is_active = intval((bool) $request->input( 'is_active'));
                $saveData->save();

                self::SaveAndUpdateDefPhoto($saveData,$request,'developer','slug');

                foreach ( config('app.web_lang') as $key=>$lang) {
                    $saveTranslation = DeveloperTranslation::where('developer_id',$saveData->id)->where('locale',$key)->firstOrNew();
                    $saveTranslation->developer_id = $saveData->id;
                    $saveTranslation = self::saveTranslationMain($saveTranslation,$key,$request);
                    $saveTranslation->save();
                }
            });

        }catch (\Exception $exception){
            return back()->with('data_not_save',"");
        }

        self::ClearCash();
        return  self::redirectWhere($request,$id,'developer.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyException($id){

        $deleteRow =  Developer::where('id',$id)
            ->withCount('del_listings')
            ->withCount('del_posts')
            ->firstOrFail();
        if($deleteRow->del_listings_count == 0 and $deleteRow->del_posts_count == 0){
            try{
                DB::transaction(function () use ($deleteRow,$id){
                    $delMorePhoto = DeveloperPhoto::where('developer_id',"=",$id)->get();
                    if(count($delMorePhoto) > 0){
                        foreach ($delMorePhoto as $del_photo ){
                            $del_photo = AdminHelper::DeleteAllPhotos($del_photo);
                        }
                    }
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    $deleteRow->forceDelete();
                });
            }catch (\Exception $exception){
                return back()->with(['confirmException'=>'','fromModel'=>'Developer','deleteRow'=>$deleteRow]);
            }
        }else{
            return back()->with(['confirmException'=>'','fromModel'=>'Developer','deleteRow'=>$deleteRow]);
        }
        self::ClearCash();
        return back()->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CheckData
    public function CheckData(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        View::share('yajraTable', false);

        if( Route::currentRouteName() == $this->PrefixRoute.'.unActive'){
            $Developers = self::getSelectQuery(Developer::where('is_active',false));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noPhoto'){
            $Developers = self::getSelectQuery(Developer::where('photo',null));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noAr'){
            $Developers = self::getSelectQuery( Developer::whereHas('teans_ar', function ($query) {$query->where('des', '=', null);}));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noEn'){
            $Developers = self::getSelectQuery( Developer::whereHas('teans_en', function ($query) {$query->where('des', '=', null);}));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.slugErr'){
            $upDateSlug = Developer::withTrashed()->where('slug_count','>',1)->get();
            if(count($upDateSlug) > 0 ){
                foreach ($upDateSlug as $newUpdate){
                    $newCount = Developer::withTrashed()->where('slug', $newUpdate->slug )->count();
                    $newUpdate->slug_count = $newCount ;
                    $newUpdate->save() ;
                }
            }
            $Developers = self::getSelectQuery(Developer::where('slug_count','!=',1));
        }
        return view('admin.developer.index',compact('pageData','Developers'));
    }

}

