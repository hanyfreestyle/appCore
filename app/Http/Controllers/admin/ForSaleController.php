<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\UnitRequest;
use App\Http\Traits\CrudTraits;
use App\Models\admin\Listing;
use App\Models\admin\ListingPhoto;
use App\Models\admin\ListingTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ForSaleController extends AdminMainController{
    use CrudTraits;
    function __construct(Listing $model,ListingPhoto $modelPhoto){
        parent::__construct();
        $this->controllerName = "ForSale";
        $this->PrefixRole = 'forSale';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/menu.unit');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;
        $this->modelPhoto = $modelPhoto ;
        $this->modelPhotoColumn = 'listing_id' ;
        $this->UploadDirIs = 'forSale' ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddConfig'=> true ,
            'configArr'=> ["morePhotoFilterid"=>1 ],
            'AddLang'=> true ,
            'yajraTable'=> true ,
            'restore'=> 1 ,
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
        $pageData['Trashed'] = Listing::onlyTrashed()->ForSaleAdmin()->count();


        if ($this->viewDataTable and $this->yajraTable){
            return view('admin.forSale.index_dataTable', compact('pageData'));
        }else{
            $Units = self::getSelectQuery(Listing::ForSaleAdmin());
            return view('admin.forSale.index',compact('pageData','Units'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function DataTable(Request $request){
        if ($request->ajax()) {
            $data = Listing::select(['listings.id','photo_thum_1','is_published','slug','slider_active'])
                ->where('listing_type','ForSale')
                ->with('tablename')
                ->withCount('admin_more_photos');

            return self::DataTableAddColumns($data)
                ->addColumn('ViewListing', function($row){
                    return  view('datatable.but')->with(['btype'=>'ViewListing','row'=>$row])->render();
                })
                ->addColumn('OldPhotos', function($row){
                    return  view('datatable.but')->with(['btype'=>'OldPhotos','row'=>$row])->render();
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
        $Units = self::getSelectQuery(Listing::onlyTrashed()->ForSaleAdmin());
        return view('admin.forSale.index',compact('pageData','Units'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $Unit = Listing::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();
        return view('admin.forSale.form',compact('pageData','Unit','LangAdd'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $Unit = Listing::ForSaleAdmin()
            ->where('id','=',$id)
            ->firstOrFail();
        $LangAdd = self::getAddLangForEdit($Unit);
        return view('admin.forSale.form',compact('pageData','Unit','LangAdd'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(UnitRequest $request, $id=0){

        try{
            DB::transaction(function () use ($request,$id){
                $saveData =  Listing::findOrNew($id);
                if($id == 0){
                    $saveData->slug = time()."-".AdminHelper::Url_Slug($request->slug);
                }else{
                    $saveData->slug = AdminHelper::Url_Slug($request->slug);
                }

                $saveData->listing_type = "ForSale";
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

                self::SaveAndUpdateDefPhoto($saveData,$request,'forSale','slug');

                if($id == 0){
                    $saveData->slug = $saveData->id."-".AdminHelper::Url_Slug($request->slug);
                    $saveData->save();
                }

                $addLang = json_decode($request->add_lang);
                foreach ( $addLang as $key=>$lang) {
                    $saveTranslation = ListingTranslation::where('listing_id',$saveData->id)->where('locale',$key)->firstOrNew();
                    $saveTranslation->listing_id = $saveData->id;
                    $saveTranslation = self::saveTranslationMain($saveTranslation,$key,$request);
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
        $deleteRow = Listing::onlyTrashed()->where('id',$id)->where('listing_type','ForSale')->firstOrFail();
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
    public function CheckData(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        View::share('yajraTable', false);

        if( Route::currentRouteName() == $this->PrefixRoute.'.unActive'){
            $Units = self::getSelectQuery(Listing::ForSaleAdmin()->where('is_published',false));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noPhoto'){
            $Units = self::getSelectQuery(Listing::ForSaleAdmin()->where('photo',null));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noAr'){
            $Units = self::getSelectQuery(Listing::ForSaleAdmin()->notTranslatedIn('ar'));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noEn'){
            $Units = self::getSelectQuery(Listing::ForSaleAdmin()->notTranslatedIn('en'));
        }
        return view('admin.forSale.index',compact('pageData','Units'));
    }

}
