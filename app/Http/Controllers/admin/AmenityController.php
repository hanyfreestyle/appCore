<?php
namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;

use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\AmenityRequest;
use App\Http\Traits\CrudTraits;
use App\Models\admin\Amenity;
use App\Models\admin\AmenityTranslation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;



class AmenityController extends AdminMainController{
    use CrudTraits;

    function __construct(Amenity $model){

        parent::__construct();
        $this->controllerName = "amenity";
        $this->PrefixRole = 'amenity';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/menu.amenity');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddConfig'=> true ,
            'restore'=> 1 ,
        ];
        self::loadConstructData($sendArr);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('CashAmenityList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Amenity::onlyTrashed()->count();

        $rowData = self::getSelectQuery( Amenity::with('translation'));
        return view('admin.amenity.index',compact('pageData','rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $rowData = self::getSelectQuery(Amenity::onlyTrashed());
        return view('admin.amenity.index',compact('pageData','rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $rowData = Amenity::findOrNew(0);
        return view('admin.amenity.form',compact('pageData','rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = Amenity::findOrFail($id);
        return view('admin.amenity.form',compact('rowData','pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text
    public function storeUpdate(AmenityRequest $request, $id=0){

        try{
            DB::transaction(function () use ($request,$id){
                if($request->input('icon') == 'empty'){
                    $request->icon = "";
                }

                $saveImgData = new PuzzleUploadProcess();
                $saveImgData->setCountOfUpload('2');
                $saveImgData->setUploadDirIs('amenity');
                $saveImgData->setnewFileName($request->input('en.name'));
                $saveImgData->UploadOne($request);

                $saveData =  Amenity::findOrNew($id);
                $saveData->icon = $request->icon;
                $saveData = AdminHelper::saveAndDeletePhoto($saveData,$saveImgData);
                $saveData->save();

                foreach ( config('app.web_lang') as $key=>$lang) {
                    $saveTranslation = AmenityTranslation::where('amenity_id',$saveData->id)->where('locale',$key)->firstOrNew();
                    $saveTranslation->amenity_id = $saveData->id;
                    $saveTranslation->locale = $key;
                    $saveTranslation->name = $request->input($key.'.name');
                    $saveTranslation->save();
                }
            });
        }catch (\Exception $exception){
            return back()->with('data_not_save',"");
        }

        self::ClearCash();
        return  self::redirectWhere($request,$id,'amenity.index');
    }

}
