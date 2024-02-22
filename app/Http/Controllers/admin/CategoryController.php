<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\CategoryRequest;
use App\Http\Traits\CrudTraits;
use App\Models\admin\Category;
use App\Models\admin\CategoryTranslation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class CategoryController extends AdminMainController{
    use CrudTraits;

    function __construct(Category $model){

        parent::__construct();
        $this->controllerName = "category";
        $this->PrefixRole = 'post';
        $this->selMenu = "Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle =  __('admin/menu.category');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddConfig'=> true ,
            'configArr'=> [ "filterid"=>0],
        ];
        self::loadConstructData($sendArr);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('PostCategoryList');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Category::onlyTrashed()->count();

        $Categories = self::getSelectQuery(Category::with('translation')->withCount('del_posts'));
        return view('admin.post.category_index',compact('pageData','Categories'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $Category = Category::findOrNew(0);
        return view('admin.post.category_form',compact('pageData','Category'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $Category = Category::findOrFail($id);
        return view('admin.post.category_form',compact('Category','pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(CategoryRequest $request, $id=0){

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('category');
        $saveImgData->setnewFileName($request->input('slug'));
        $saveImgData->UploadOne($request);

        $saveData =  Category::findOrNew($id);
        $saveData->slug = AdminHelper::Url_Slug($request->slug);
        $saveData->is_active = intval((bool) $request->input( 'is_active'));
//        $saveData = AdminHelper::saveAndDeletePhoto($saveData,$saveImgData);
        $saveData->save();


        foreach ( config('app.web_lang') as $key=>$lang) {
            $saveTranslation = CategoryTranslation::where('category_id',$saveData->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->category_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key.'.name');
            $saveTranslation->g_title = $request->input($key.'.g_title');
            $saveTranslation->g_des = $request->input($key.'.g_des');
            $saveTranslation->save();
        }

        self::ClearCash();
        return  self::redirectWhere($request,$id,$this->PrefixRoute.'.index');

   }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyException($id){
        $deleteRow =  Category::where('id',$id)
            ->withCount('del_posts')
            ->firstOrFail();
        if($deleteRow->del_posts_count == 0 ){
            try{
                DB::transaction(function () use ($deleteRow,$id){
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    $deleteRow->forceDelete();
                });
            }catch (\Exception $exception){
                return back()->with(['confirmException'=>'','fromModel'=>'Category','deleteRow'=>$deleteRow]);
            }
        }else{
            return back()->with(['confirmException'=>'','fromModel'=>'Category','deleteRow'=>$deleteRow]);
        }
        self::ClearCash();
        return back()->with('confirmDelete',"");
    }


}
