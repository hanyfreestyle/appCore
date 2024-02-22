<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;

use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\ProjectRequest;
use App\Http\Traits\CrudTraits;
use App\Models\admin\Developer;
use App\Models\admin\DeveloperPhoto;
use App\Models\admin\Listing;
use App\Models\admin\ListingPhoto;
use App\Models\admin\ListingTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ProjectController extends AdminMainController{

    use CrudTraits;

    function __construct(Listing $model,ListingPhoto $modelPhoto){
        parent::__construct();
        $this->controllerName = "project";
        $this->PrefixRole = 'project';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/menu.project');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;
        $this->modelPhoto = $modelPhoto ;
        $this->modelPhotoColumn = 'listing_id' ;
        $this->UploadDirIs = 'project' ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddConfig'=> true ,
            'configArr'=> ["morePhotoFilterid"=>1 ],
            'yajraTable'=> true ,
            'AddLang'=> true ,
        ];

        self::loadConstructData($sendArr);

        $this->CashLocationList = self::CashLocationList($this->StopeCash);
        View::share('CashLocationList', $this->CashLocationList);

        $this->CashDeveloperList = self::CashDeveloperList($this->StopeCash);
        View::share('CashDeveloperList', $this->CashDeveloperList);

        $this->CashAmenityList = self::CashAmenityList($this->StopeCash);
        View::share('CashAmenityList', $this->CashAmenityList);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('CashCompoundList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Listing::onlyTrashed()->where('listing_type','Project')->with('translations')->count();

        if ($this->viewDataTable and $this->yajraTable){
            return view('admin.project.index_dataTable', compact('pageData'));
        }else{
            $Projects = self::getSelectQuery(Listing::ProjectAdmin());
            return view('admin.project.index',compact('pageData','Projects'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function DataTable(Request $request){
        if ($request->ajax()) {
            $data = Listing::select(['listings.id','photo_thum_1','is_published','slug','slider_active'])
                ->where('listing_type','Project')
                ->with('tablename')
                ->withCount('admin_more_photos')
                ->withCount('admin_units')
                ->withCount('admin_faqs');

            return self::DataTableAddColumns($data)
                ->addColumn('ViewListing', function($row){
                    return  view('datatable.but')->with(['btype'=>'ViewListing','row'=>$row])->render();
                })
                ->addColumn('OldPhotos', function($row){
                    return  view('datatable.but')->with(['btype'=>'OldPhotos','row'=>$row])->render();
                })
                ->addColumn('ProjectPhoto', function($row){
                    return  view('datatable.but')->with(['btype'=>'ProjectPhoto','row'=>$row])->render();
                })
                ->addColumn('ProjectUnits', function($row){
                    return  view('datatable.but')->with(['btype'=>'ProjectUnits','row'=>$row])->render();
                })
                ->addColumn('ProjectFaq', function($row){
                    return  view('datatable.but')->with(['btype'=>'ProjectFaq','row'=>$row])->render();
                })
                ->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        View::share('yajraTable', false);
        $Projects = self::getSelectQuery(Listing::onlyTrashed()->ProjectAdmin());
        return view('admin.project.index',compact('pageData','Projects'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $LangAdd = self::getAddLangForAdd();
        $Project = Listing::findOrNew(0);
        return view('admin.project.form',compact('pageData','Project','LangAdd'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $Project = Listing::where('id','=',$id)->ProjectAdmin()->firstOrFail();
        $LangAdd = self::getAddLangForEdit($Project);
        return view('admin.project.form',compact('pageData','Project','LangAdd'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(ProjectRequest $request, $id=0){

        try{
            DB::transaction(function () use ($request,$id){

                $saveData =  Listing::findOrNew($id);

                if($id == 0){
                    $saveData->slug = time()."-".AdminHelper::Url_Slug($request->slug);
                }else{
                    $saveData->slug = AdminHelper::Url_Slug($request->slug);
                }

                $saveData->listing_type = "Project";
                $saveData->location_id = $request->input('location_id');
                $saveData->developer_id  = $request->input('developer_id');
                $saveData->project_type  = $request->input('project_type');
                $saveData->status  = $request->input('status');
                $saveData->delivery_date  = $request->input('delivery_date');
                $saveData->price  = $request->input('price');
                $saveData->latitude   = $request->input('latitude');
                $saveData->longitude   = $request->input('longitude');
                $saveData->youtube_url   = $request->input('youtube_url');
                $saveData->is_published = intval((bool) $request->input( 'is_published'));
                $saveData->amenity  = $request->input('amenity');
                $saveData->save();

                if($id == 0){
                    $saveData->slug = $saveData->id."-".AdminHelper::Url_Slug($request->slug);
                    $saveData->save();
                }

                self::SaveAndUpdateDefPhoto($saveData,$request,'project','slug');
                $addLang = json_decode($request->add_lang);

                foreach ( $addLang as $key=>$lang) {
                    $saveTranslation = ListingTranslation::where('listing_id',$saveData->id)->where('locale',$key)->firstOrNew();
                    $saveTranslation->listing_id = $saveData->id;
                    $saveTranslation = self::saveTranslationMain($saveTranslation,$key,$request);
                    $saveTranslation->save();
                }

                $UpdateUnits = Listing::query()
                    ->where('parent_id', '=', $saveData->id)
                    ->get();

                if(count($UpdateUnits) > 0){
                    foreach ($UpdateUnits as $UpdateUnit){
                        $UpdateUnit->location_id = $request->input('location_id');
                        $UpdateUnit->developer_id  = $request->input('developer_id');
                        $UpdateUnit->delivery_date  = $request->input('delivery_date');
                        $UpdateUnit->save();
                    }
                }
            });

        }catch (\Exception $exception){
            return back()->with('data_not_save',"");
        }

        self::ClearCash();
        return  self::redirectWhere($request,$id,$this->PrefixRoute.'.index');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     DeleteLang
    public function DeleteLang($id){
        $deleteRow = ListingTranslation::where('id',$id)->firstOrFail();
        $countLang = ListingTranslation::where('listing_id',$deleteRow->listing_id)->count();
        if($countLang > 1){
            $deleteRow->delete();
        }else{
            abort(404);
        }
        self::ClearCash();
        return redirect(route($this->PrefixRoute.'.edit',$deleteRow->listing_id))->with('confirmDelete',"");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function destroyException($id){
        $deleteRow =  Listing::where('id',$id)
            ->withCount('del_units')
            ->withCount('del_pages')
            ->withCount('del_posts')
            ->firstOrFail();

        if($deleteRow->del_units_count == 0 and $deleteRow->del_pages_count == 0 and $deleteRow->del_posts_count == 0){
            try{
                DB::transaction(function () use  ($deleteRow,$id){
                    $delMorePhoto = ListingPhoto::where('listing_id',"=",$id)->get();
                    if(count($delMorePhoto) > 0){
                        foreach ($delMorePhoto as $del_photo ){
                            $del_photo = AdminHelper::DeleteAllPhotos($del_photo);
                        }
                    }
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    $deleteRow->forceDelete();
                });
            }catch (\Exception $exception){
                return back()->with(['confirmException'=>'','fromModel'=>'Project','deleteRow'=>$deleteRow]);
            }
        }else{
            return back()->with(['confirmException'=>'','fromModel'=>'Project','deleteRow'=>$deleteRow]);
        }

        self::ClearCash();
        return back()->with('confirmDelete',"");
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyExceptionSS($id){

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
                return back()->with('confirmException',"");
            }
        }else{
            return back()->with('confirmException',"");
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
            $Projects = self::getSelectQuery(Listing::ProjectAdmin()->where('is_published',false));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noPhoto'){
            $Projects = self::getSelectQuery(Listing::ProjectAdmin()->where('photo',null));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noAr'){
            $Projects = self::getSelectQuery(Listing::ProjectAdmin()->notTranslatedIn('ar'));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noEn'){
            $Projects = self::getSelectQuery(Listing::ProjectAdmin()->notTranslatedIn('en'));
        }
        return view('admin.project.index',compact('pageData','Projects'));
    }

}
