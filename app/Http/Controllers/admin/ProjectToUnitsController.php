<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\ProjectToUnitsRequest;
use App\Http\Traits\CrudTraits;
use App\Models\admin\Listing;
use App\Models\admin\ListingPhoto;
use App\Models\admin\ListingTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



class ProjectToUnitsController extends AdminMainController{
    use CrudTraits;

    function __construct(Request $request,Listing $model,ListingPhoto $modelPhoto){
        parent::__construct();
        $this->controllerName = "ProjectUnits";
        $this->PrefixRole = 'project';
        $this->selMenu = "project.";
        $this->PrefixCatRoute = "";
        $this->PageTitle =  __('admin/project.units_project_title');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;
        $this->modelPhoto = $modelPhoto ;
        $this->modelPhotoColumn = 'listing_id' ;
        $this->UploadDirIs = 'units' ;


        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddConfig'=> true ,
            'configArr'=> ["morePhotoFilterid"=>1 ],
            'AddLang'=> true ,
            'restore'=> 1 ,
            'WithSubCat'=> true,
            'ModelId'=> $request->route()->parameter('projectId'),
        ];

        self::loadConstructData($sendArr);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('emptyList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(Request $request, $projectId){

        $Project = Listing::withTrashed()->where('id','=',$projectId)->where('listing_type','Project')->firstOrFail();
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Listing::onlyTrashed()->where('parent_id', '=',$projectId )->count();
        $Units = self::getSelectQuery(Listing::UnitsAdmin()->where('parent_id',$projectId));

        return view('admin.units.index',compact('pageData','Units','Project'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes($projectId){
        $Project = Listing::withTrashed()->where('id','=',$projectId)->where('listing_type','Project')->firstOrFail();
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";

        $Units = self::getSelectQuery(Listing::onlyTrashed()->UnitsAdmin()->where('parent_id',$projectId));
        return view('admin.units.index',compact('pageData','Units','Project'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create($projectId){
        $Project = Listing::where('id','=',$projectId)
            ->where('listing_type','Project')
            ->with('developerName')
            ->with('locationName')
            ->firstOrFail();

        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $Unit = Listing::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();
        return view('admin.units.form',compact('pageData','Unit','Project','LangAdd'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit(Request $request){
        $id = $request->route()->parameter('id');
        $Unit = Listing::UnitsAdmin()->where('id',$id)->firstOrFail();

        $Project = Listing::where('id','=',$Unit->parent_id)
            ->with('developerName')
            ->with('locationName')
            ->firstOrFail();

        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $LangAdd = self::getAddLangForEdit($Unit);

        return view('admin.units.form',compact('pageData','Unit','Project','LangAdd'));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(ProjectToUnitsRequest $request, $id=0){

        try{
            DB::transaction(function () use ($request,$id){

                $saveData =  Listing::findOrNew($id);

                if($id == 0){
                    $saveData->slug = time()."-".AdminHelper::Url_Slug($request->slug);
                }else{
                    $saveData->slug = AdminHelper::Url_Slug($request->slug);
                }

                $saveData->listing_type = "Unit";
                $saveData->parent_id = $request->input('parent_id');
                $saveData->location_id = $request->input('location_id');
                $saveData->developer_id  = $request->input('developer_id');
                $saveData->property_type  = $request->input('property_type');
                $saveData->view  = $request->input('view');
                $saveData->amenity  = $request->input('amenity');
                $saveData->delivery_date  = $request->input('delivery_date');
                $saveData->price  = $request->input('price');
                $saveData->area  = $request->input('area');
                $saveData->baths  = $request->input('baths');
                $saveData->rooms  = $request->input('rooms');
                $saveData->unit_status  = $request->input('unit_status');
                $saveData->latitude   = $request->input('latitude');
                $saveData->longitude   = $request->input('longitude');
                $saveData->youtube_url   = $request->input('youtube_url');
                $saveData->is_published = intval((bool) $request->input( 'is_published'));
                $saveData->save();

                self::SaveAndUpdateDefPhoto($saveData,$request,'units','slug');

                if($id == 0){
                    $saveData->slug = $saveData->id."-".AdminHelper::Url_Slug($request->slug);
                    $saveData->save();
                }

                $addLang = json_decode($request->add_lang);

                foreach ($addLang as $key=>$lang) {
                    $saveTranslation = ListingTranslation::where('listing_id',$saveData->id)
                        ->where('locale',$key)
                        ->firstOrNew();
                    $saveTranslation->listing_id = $saveData->id;
                    $saveTranslation->locale = $key;
                    $saveTranslation = self::saveTranslationMain($saveTranslation,$key,$request);
                    $saveTranslation->save();
                }

            });

        }catch (\Exception $exception){
            return back()->with('data_not_save',"");
        }

        self::ClearCash();
        return  self::redirectWhereNew($request,$id, route($this->PrefixRoute.'.index',$request->input('parent_id')));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     DeleteLang
    public function DeleteLang($id){
        $deleteRow = ListingTranslation::where('id',$id)->firstOrFail();
        $Listing = Listing::where('id',$deleteRow->listing_id)->firstOrFail();
        $countLang = ListingTranslation::where('listing_id',$deleteRow->listing_id)->count();
        if($countLang > 1){
            $deleteRow->delete();
        }else{
            abort(404);
        }
        self::ClearCash();
        return redirect(route($this->PrefixRoute.'.edit',[$Listing->parent_id,$deleteRow->listing_id]))->with('confirmDelete',"");
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function destroyException($id){
        $deleteRow = Listing::onlyTrashed()->where('id',$id)->where('listing_type','Unit')->firstOrFail();
        try{
            DB::transaction(function () use ($deleteRow){
                $delMorePhoto = ListingPhoto::where('listing_id',"=",$deleteRow->id)->get();
                if(count($delMorePhoto) > 0){
                    foreach ($delMorePhoto as $del_photo ){
                        $del_photo = AdminHelper::DeleteAllPhotos($del_photo);
                    }
                }
                $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                $deleteRow->forceDelete();
            });

        }catch (\Exception $exception){
            return back()->with('confirmNotDelete',"");
        }
        self::ClearCash();
        return back()->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CheckData
    public function CheckData($projectId){
        $Project = Listing::withTrashed()->where('id','=',$projectId)->where('listing_type','Project')->firstOrFail();
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        if( Route::currentRouteName() == $this->PrefixRoute.'.unActive'){
            $Units = self::getSelectQuery(Listing::UnitsAdmin()->where('parent_id',$projectId)->where('is_published',false));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noPhoto'){
            $Units = self::getSelectQuery(Listing::UnitsAdmin()->where('parent_id',$projectId)->where('photo',null));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noAr'){
            $Units = self::getSelectQuery(Listing::UnitsAdmin()->where('parent_id',$projectId)->notTranslatedIn('ar'));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noEn'){
            $Units = self::getSelectQuery(Listing::UnitsAdmin()->where('parent_id',$projectId)->notTranslatedIn('en'));
        }
        return view('admin.units.index',compact('pageData','Units','Project'));
    }


}
