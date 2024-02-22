<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Models\admin\config\UploadFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Spatie\Valuestore\Valuestore;
use Yajra\DataTables\Facades\DataTables;

class AdminMainController extends DefaultMainController
{

    public $modelSettings;
    public $StopeCash;

    public function __construct(
        $StopeCash = 0 ,
    )
    {

        parent::__construct();
        $this->middleware('auth');
        $this->StopeCash = $StopeCash ;

        View::share('filterTypes', UploadFilter::cash_UploadFilter());

        $modelsNameArr = [
            "1"=> ['id'=>'1','name'=>__('admin/config/roles.model_01')],
            "2"=> ['id'=>'2','name'=>__('admin/config/roles.model_02')],
            "3"=> ['id'=>'3','name'=>__('admin/config/roles.model_03')],
            "4"=> ['id'=>'4','name'=>__('admin/config/roles.model_04')],
            "5"=> ['id'=>'5','name'=>__('admin/config/roles.model_05')],
            "6"=> ['id'=>'6','name'=>__('admin/config/roles.model_06')],
            "7"=> ['id'=>'7','name'=>__('admin/config/roles.model_07')],
            "8"=> ['id'=>'8','name'=>__('admin/config/roles.model_08')],
            "9"=> ['id'=>'9','name'=>__('admin/config/roles.model_09')],
            "10"=> ['id'=>'10','name'=>__('admin/config/roles.model_10')],
            "11"=> ['id'=>'11','name'=>__('admin/config/roles.model_11')],
            "12"=> ['id'=>'12','name'=>__('admin/config/roles.model_12')],

//            "13"=> ['id'=>'13','name'=>__('admin/config/roles.model_13')],
//            "14"=> ['id'=>'14','name'=>__('admin/config/roles.model_14')],
//            "15"=> ['id'=>'15','name'=>__('admin/config/roles.model_15')],


        ];
        View::share('modelsNameArr', $modelsNameArr);

        $FilterTypeArr = [
            "1"=> ['id'=>'1','name'=>__('admin/config/upFilter.filter_action_1')],
            "2"=> ['id'=>'2','name'=>__('admin/config/upFilter.filter_action_2')],
            "3"=> ['id'=>'3','name'=>__('admin/config/upFilter.filter_action_3')],
            "4"=> ['id'=>'4','name'=>__('admin/config/upFilter.filter_action_4')],
            "5"=> ['id'=>'5','name'=>__('admin/config/upFilter.filter_action_5')],
        ];
        View::share('filterTypeArr', $FilterTypeArr);





        $BrokenUrl_Arr = [
            "1"=> ['id'=>'Root','name'=> __('admin/broken.list-Root')],
            "2"=> ['id'=>'Developer','name'=> __('admin/broken.list-Developer') ],
            "3"=> ['id'=>'Pages','name'=> __('admin/broken.list-Pages') ],
            "4"=> ['id'=>'Blog','name'=> __('admin/broken.list-Blog') ],
            "5"=> ['id'=>'Listing','name'=> __('admin/broken.list-Listing')],
        ];
        View::share('BrokenUrl_Arr', $BrokenUrl_Arr);



        $modelSettings = Valuestore::make(config_path(config('app.model_settings_name')));
        $modelSettings = $modelSettings->all();
        $this->modelSettings = $modelSettings ;
        View::share('modelSettings', $modelSettings);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ForgetSession
    public function ForgetSession(Request $request){
        Session::forget($request->input('formName'));
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   getSessionData
    public function getSessionData($request){

        if(isset($request->formName) ){

            $request->validate([
                'from_date' => 'nullable|date|date_format:Y-m-d',
                'to_date'  => 'nullable|date|after_or_equal:from_date',
            ]);
            Session::put($this->formName,$request->all());
            Session::save();
        }
        $session =  Session::get($this->formName);
        return $session ;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function FilterQ($query,$session,$order=null){
        $query->where('id','!=',0);

        if(isset($session['from_date']) and $session['from_date'] != null){
            $query->whereDate('created_at','>=',Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if(isset($session['to_date']) and $session['to_date'] != null){
            $query->whereDate('created_at','<=',Carbon::createFromFormat('Y-m-d', $session['to_date']));
        }

        if(isset($session['country']) and $session['country'] != null){
            $query->where('country',$session['country']);
        }

        if(isset($session['project_id']) and $session['project_id'] != null){
            $query->where('project_id',$session['project_id']);
        }

        if(isset($session['is_active']) and $session['is_active'] != null){
            $query->where('is_active',$session['is_active']);
        }

        if(isset($session['continent_code']) and $session['continent_code'] != null){
            $query->where('continent_code',$session['continent_code']);
        }

        if($order != null){
            $orderBy = explode("|",$order);
            $query->orderBy($orderBy[0],$orderBy[1]);
        }

        return $query;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getDefSetting
    public function getDefSetting($controllerName,$key,$def){
        if(isset($this->modelSettings[$controllerName.$key])){
            return $this->modelSettings[$controllerName.$key];
        }else{
            return $def;
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getSelect
    public function getSelectQuery($query){
        $controllerName = $this->controllerName;

        $perPage = self::getDefSetting($controllerName,'_perpage','5');
        $dataTable =  self::getDefSetting($controllerName,'_datatable','0');
        $orderBy =  self::getDefSetting($controllerName,'_orderby','1');

        switch ($orderBy){
            case 1:
                $query->orderBy('id','DESC');
                break;
            case 2:
                $query->orderBy('id','ASC');
                break;
            case 3:
                $query->orderByTranslation('name','DESC');
                break;
            case 4:
                $query->orderByTranslation('name','ASC');
                break;
            case 5:
                $query->orderBy('postion','ASC');
                break;
            case 6:
                $query->orderBy('created_at','DESC');
                break;
            case 7:
                $query->orderBy('created_at','ASC');
                break;
            default:
        }

        if($dataTable == '1'){
            return $query->get();
        }else{
            return $query->paginate($perPage);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # GetAddLangForAdd
    public function getAddLangForAdd(){
        //dd($this->PrefixRoute);
        if( Route::currentRouteName() == $this->PrefixRoute.'.create_ar'){
            $LangAdd = ['ar'=>'Arabic'];
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.create_en'){
            $LangAdd = ['en'=>'English'];
        }else{
            $LangAdd = ['ar'=>'Arabic','en'=>'English'];
        }
        return $LangAdd ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # getAddLangForEdit
    public function getAddLangForEdit($row){
        $LangAdd = [];
        if( Route::currentRouteName() == $this->PrefixRoute.'.editAr'){
            $LangAdd = ['ar'=>'Arabic'];
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.editEn'){
            $LangAdd = ['en'=>'English'];
        }else{
            foreach ($row->translations as  $Lang){
                if($Lang->locale == 'ar'){
                    $LangAdd += ['ar'=>'Arabic'];
                }
                if($Lang->locale == 'en'){
                    $LangAdd += ['en'=>'English'];
                }
            }
        }
        return $LangAdd ;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # saveTranslation
    public function saveTranslationMain($saveTranslation,$key,$request){
        $saveTranslation->locale = $key;
        $saveTranslation->name = $request->input($key.'.name');
        $saveTranslation->des = $request->input($key.'.des');
        if($request->input($key.'.g_title') == null){
            $saveTranslation->g_title =  $request->input($key.'.name');
        }else{
            $saveTranslation->g_title = $request->input($key.'.g_title');
        }
        if($request->input($key.'.g_des') == null){
            $saveTranslation->g_des =  AdminHelper::seoDesClean($request->input($key.'.des')) ;
        }else{
            $saveTranslation->g_des = $request->input($key.'.g_des');
        }
        return $saveTranslation ;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # loadConstructData
    public function loadConstructData($sendArr){
        $this->configView = AdminHelper::arrIsset($sendArr,'configView',null) ;
//        'configArr'=> ["datatable"=>1,"orderby"=>1,"orderbyPostion"=>1,"filterid"=>1,"morePhotoFilterid"=>1,"orderbyDate"=>1,"editor"=>1,"icon"=>1,]
//       'configArr'=> [ "filterid"=>1,"morePhotoFilterid"=>1 ]
        $this->configArr = AdminHelper::arrIsset($sendArr,'configArr',array()) ;

        $this->middleware('permission:'.$this->PrefixRole.'_view', ['only' => ['index']]);
        $this->middleware('permission:'.$this->PrefixRole.'_add', ['only' => ['create']]);
        $this->middleware('permission:'.$this->PrefixRole.'_edit', ['only' => ['edit','updateStatus','emptyPhoto','editRoleToPermission']]);
        $this->middleware('permission:'.$this->PrefixRole.'_delete', ['only' => ['destroy']]);
        $this->middleware('permission:'.$this->PrefixRole.'_restore', ['only' => ['SoftDeletes','Restore','ForceDelete']]);

        $viewDataTable = AdminHelper::arrIsset($this->modelSettings,$this->controllerName.'_datatable',0) ;
        $this->viewDataTable = $viewDataTable ;
        $viewEditor = AdminHelper::arrIsset($this->modelSettings,$this->controllerName.'_editor',0) ;

        $yajraTable = AdminHelper::arrIsset($sendArr,'yajraTable',false) ;
        View::share('yajraTable', $yajraTable);
        View::share('viewDataTable', $viewDataTable);
        View::share('viewEditor', $viewEditor);
        View::share('PrefixRoute', $this->PrefixRoute);
        View::share('PrefixRole', $this->PrefixRole);
        View::share('controllerName', $this->controllerName);
        View::share('PrefixCatRoute', $this->PrefixCatRoute);
        View::share('configArr', $this->configArr);
        View::share('PrintLocaleName','name_'.thisCurrentLocale());

        $this->formName = AdminHelper::arrIsset($sendArr,'formName',null) ;
        View::share('formName', $this->formName );

        $pageData = AdminHelper::returnPageDate($sendArr);
        $this->pageData = $pageData ;
        $this->yajraTable = $yajraTable ;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  redirectWhere
    public function redirectWhere($request,$id,$route){
        if($id == '0'){
            if($request->input('AddNewSet') !== null){
                return redirect()->back();
            }else{
                return redirect(route($route))->with('Add.Done',"");
            }
        }else{
            if($request->input('GoBack') !== null){
                return redirect()->back()->with('Edit.Done',"");
            }else{
                return redirect(route($route))->with('Edit.Done',"");
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function SaveAndUpdateDefPhoto($saveData,$request,$dir,$slug="slug"){
        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs($dir.'/'.$saveData->id);
        $saveImgData->setnewFileName($request->input($slug));
        $saveImgData->UploadOne($request);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData,$saveImgData);
        $saveData->save();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  redirectWhere
    public function redirectWhereNew($request,$id,$route){
        if($id == '0'){
            if($request->input('AddNewSet') !== null){
                return redirect()->back();
            }else{
                return redirect($route)->with('Add.Done',"");
            }
        }else{
            if($request->input('GoBack') !== null){
                return redirect()->back()->with('Edit.Done',"");
            }else{
                return redirect($route)->with('Edit.Done',"");
            }
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ConfigModelUpdate
    public function ConfigModelUpdate (Request $request){

        $model_id = $request->input('model_id')."_";
        $PrefixRoute = $request->input('PrefixRoute').".index";

        $this->validate($request, [
            $model_id.'perpage' => 'sometimes|required|integer|between:1,100',
            $model_id.'datatable' => 'sometimes|required',
            $model_id.'filterid' => 'sometimes|required',
            $model_id.'orderby' => 'sometimes|required',
        ]);

        $valuestore = Valuestore::make(config_path(config('app.model_settings_name')));
        foreach ($request->all()  as $key => $value){
            $valuestore->put($key, $value);
        }
        $valuestore->forget('_token');
        $valuestore->forget('B1');
        $valuestore->forget('model_id');

        if($request->input('GoBack') !== null){
            return redirect()->back()->with('Edit.Done',"");
        }else{
            if(Route::has($PrefixRoute)) {
                if($request->input('ModelId') != null){
                    return redirect(route($PrefixRoute,$request->input('ModelId')))->with('Edit.Done',"");
                }else{
                    return redirect(route($PrefixRoute))->with('Edit.Done',"");
                }
            }else{
                return redirect()->back()->with('Edit.Done',"");
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  DataTableAddColumns
    public function DataTableAddColumns($data,$arr=array()){

        $viewPhoto = AdminHelper::arrIsset($arr,'Photo',true);
//        $OldPhotos = AdminHelper::arrIsset($arr,'OldPhotos',false);
//        $ProjectUnits = AdminHelper::arrIsset($arr,'ProjectUnits',false);

        return DataTables::eloquent($data)

            ->addIndexColumn()

            ->addColumn('tablename.0.name', function($row){
                return $row->tablename[0]->name ?? ' ';
            })

            ->addColumn('tablename.1.name', function($row){
                return $row->tablename[1]->name ?? ' ';
            })

            ->addColumn('photo', function($row) use ($viewPhoto){
                if($viewPhoto){
                    return  TablePhoto($row);
                }
            })

            ->addColumn('is_active', function($row){
                return is_active($row->is_active);
            })

            ->addColumn('is_published', function($row){
                  return is_active($row->is_published);
            })

            ->addColumn('AddLang', function($row){
                return  view('datatable.but')->with(['btype'=>'addLang','row'=>$row])->render();
            })

            ->addColumn('MorePhoto', function($row){
                return  view('datatable.but')->with(['btype'=>'MorePhoto','row'=>$row])->render();
            })
            ->addColumn('Edit', function($row){
                return  view('datatable.but')->with(['btype'=>'Edit','row'=>$row])->render();
            })

            ->addColumn('Delete', function($row){
                return  view('datatable.but')->with(['btype'=>'Delete','row'=>$row])->render();
            })

            ->rawColumns(["photo","is_active","is_published",'Edit',"Delete",'MorePhoto','AddLang','OldPhotos','ViewListing','ProjectUnits','ProjectFaq','ProjectPhoto']);
    }
}
