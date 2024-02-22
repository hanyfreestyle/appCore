<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\PostRequest;
use App\Http\Traits\CrudTraits;
use App\Models\admin\Post;
use App\Models\admin\PostPhoto;
use App\Models\admin\PostTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class PostController extends AdminMainController{
    use CrudTraits;
    function __construct(Post $model,PostPhoto $modelPhoto ){

        parent::__construct();
        $this->controllerName = "post";
        $this->PrefixRole = 'post';
        $this->selMenu = "Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle =  __('admin/menu.post');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;
        $this->modelPhoto = $modelPhoto ;
        $this->modelPhotoColumn = 'post_id' ;
        $this->UploadDirIs = 'blog' ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddLang'=> true ,
            'AddConfig'=> true ,
            'yajraTable'=> true ,
            'configArr'=> ["morePhotoFilterid"=>1 ],
            'restore'=> 1 ,
        ];
        self::loadConstructData($sendArr);

        $this->CashLocationList = self::CashLocationList($this->StopeCash);
        View::share('CashLocationList', $this->CashLocationList);

        $this->CashDeveloperList = self::CashDeveloperList($this->StopeCash);
        View::share('CashDeveloperList', $this->CashDeveloperList);

        $this->CashPostCategoryList = self::CashPostCategoryList($this->StopeCash);
        View::share('CashPostCategoryList', $this->CashPostCategoryList);

        $this->CashCompoundList = self::CashCompoundList($this->StopeCash);
        View::share('CashCompoundList', $this->CashCompoundList);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('emptyList');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Post::onlyTrashed()->count();

        if ($this->viewDataTable and $this->yajraTable){
            return view('admin.post.post_index_dataTable',compact('pageData'));
        }else{
            $Posts = self::getSelectQuery(Post::with('translations')->withCount('admin_more_photos'));
            return view('admin.post.post_index',compact('pageData','Posts'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function DataTable(Request $request){
        if ($request->ajax()) {
            $data = Post::select(['posts.id','photo_thum_1','is_published'])->with('tablename');
            return self::DataTableAddColumns($data)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        View::share('yajraTable', false);
        $Posts = self::getSelectQuery(Post::onlyTrashed());
        return view('admin.post.post_index',compact('pageData','Posts'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $LangAdd = self::getAddLangForAdd();
        $Post = Post::findOrNew(0);
        return view('admin.post.post_form',compact('pageData','Post','LangAdd'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $Post = Post::with('translations')->findOrFail($id);
        $LangAdd = self::getAddLangForEdit($Post);
        return view('admin.post.post_form',compact('pageData','Post','LangAdd'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(PostRequest $request, $id=0){

        try{
            DB::transaction(function () use ($request,$id){
                $saveData =  Post::findOrNew($id);
                $saveData->slug = AdminHelper::Url_Slug($request->slug);
                $saveData->category_id = $request->input('category_id');
                $saveData->developer_id = $request->input('developer_id');
                $saveData->location_id = $request->input('location_id');
                $saveData->listing_id = $request->input('listing_id');
                $saveData->is_published = intval((bool) $request->input( 'is_published'));
                $saveData->save();
                self::SaveAndUpdateDefPhoto($saveData,$request,'blog','slug');

                $addLang = json_decode($request->add_lang);
                foreach ($addLang as $key=>$lang) {
                    $saveTranslation = PostTranslation::where('post_id',$saveData->id)->where('locale',$key)->firstOrNew();
                    $saveTranslation->post_id = $saveData->id;
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
        $deleteRow = PostTranslation::where('id',$id)->firstOrFail();
        $countLang = PostTranslation::where('post_id',$deleteRow->post_id)->count();
        if($countLang > 1){
            $deleteRow->delete();
        }else{
            abort(404);
        }
        self::ClearCash();
        return redirect(route($this->PrefixRoute.'.edit',$deleteRow->post_id))->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeletes($id){
        $deleteRow =  Post::onlyTrashed()->where('id',$id)->firstOrFail();

        $delMorePhoto = PostPhoto::where('post_id',"=",$id)->get();
        if(count($delMorePhoto) > 0){
            foreach ($delMorePhoto as $del_photo ){
                $del_photo = AdminHelper::DeleteAllPhotos($del_photo);
            }
        }

        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->forceDelete();
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
            $Posts = self::getSelectQuery( Post::where('is_published',false)->with('admin_more_photos'));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noPhoto'){
            $Posts = self::getSelectQuery( Post::where('photo',null)->with('admin_more_photos'));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noAr'){
            $Posts = self::getSelectQuery( Post::with('admin_more_photos')->notTranslatedIn('ar'));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noEn'){
            $Posts = self::getSelectQuery( Post::with('admin_more_photos')->notTranslatedIn('en'));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.slugErr'){
            $upDateSlug = Post::withTrashed()->where('slug_count','>',1)->get();
            if(count($upDateSlug) > 0 ){
                foreach ($upDateSlug as $newUpdate){
                    $newCount = Post::withTrashed()->where('slug', $newUpdate->slug )->count();
                    $newUpdate->slug_count = $newCount ;
                    $newUpdate->save() ;
                }
            }
            $Posts = self::getSelectQuery( Post::where('slug_count','>',1)->with('admin_more_photos'));
        }
        return view('admin.post.post_index',compact('pageData','Posts'));
    }

}
