<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\PageRequest;
use App\Http\Traits\CrudTraits;
use App\Models\admin\Page;
use App\Models\admin\PageTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class PageAdminController extends AdminMainController{
    use CrudTraits;

    public $CashPagesData ;
    public $CashCompoundList ;
    public $CashLocationList ;

    function __construct(Page $model,)
    {
        parent::__construct();
        $this->controllerName = "pages";
        $this->PrefixRole = 'pages';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/menu.pages');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddConfig'=> true ,
            'configArr'=> ["filterid"=>0,"datatable"=>0 ],
            'restore'=> 1 ,
        ];
        self::loadConstructData($sendArr);


        $this->CashPagesData = self::CashPagesList($this->StopeCash);
        View::share('CashPagesData', $this->CashPagesData);

        $this->CashCompoundList = self::CashCompoundList($this->StopeCash);
        View::share('CashCompoundList', $this->CashCompoundList);

        $this->CashLocationList = self::CashLocationList($this->StopeCash);
        View::share('CashLocationList', $this->CashLocationList);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('CashPagesList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index($id=0){

        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Page::onlyTrashed()->count();

        if( Route::currentRouteName()== 'pages.location_index'){
            $Pages = self::getSelectQuery( Page::where('location_id',$id)->with('translation')->with('loaction')->with('project'));
        }elseif (Route::currentRouteName()== 'pages.compound_index'){
            $Pages = self::getSelectQuery( Page::where('compound_id',$id)->with('translation')->with('loaction')->with('project'));
        }else{
            $Pages = self::getSelectQuery( Page::where('id',"!=","0")->with('translation')->with('loaction')->with('project'));
         }

        return view('admin.page.index',compact('pageData','Pages'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $Pages = self::getSelectQuery(Page::onlyTrashed());
        return view('admin.page.index',compact('pageData','Pages'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $Page = Page::findOrNew(0);
        $Page->links = array();
        $Page->property_type = array();
        return view('admin.page.form',compact('pageData','Page'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $Page = Page::findOrFail($id);
        if($Page->links == null){
            $Page->links = array();
        }
        if($Page->property_type == null){
            $Page->property_type = array();
        }

        return view('admin.page.form',compact('pageData','Page'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(PageRequest $request, $id=0){

        $saveData =  Page::findOrNew($id);
        $saveData->location_id = $request->input('location_id');
        $saveData->compound_id = $request->input('compound_id');
        $saveData->property_type = $request->input('property_type');
        $saveData->links = $request->input('links');
        $saveData->is_active = intval((bool) $request->input( 'is_active'));
        $saveData->hash =  self::createHash($request);
        $saveData->save();

        foreach ( config('app.web_lang') as $key=>$lang) {
            $saveTranslation = PageTranslation::where('page_id',$saveData->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->page_id = $saveData->id;
            $saveTranslation = self::saveTranslationMain($saveTranslation,$key,$request);
            $saveTranslation->save();
        }

        self::ClearCash();
        return  self::redirectWhere($request,$id,'pages.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # createHash
    static function createHash(Request $request){
        $hash_new = '?';

        if ($request->input('location_id') != null)
        {
            $hash_new .= "location=" . $request->input('location_id');
        }
        if ($request->input('compound_id') != null)
        {
            if ($request->input('location_id') != null)
            {
                $hash_new .= '&';
            }
            $hash_new .= "compound=" . $request->input('compound_id');
        }

        if ($request->input('property_type') != null)
        {
            $hash_new .= "&property_type=" . implode(',', $request->input('property_type'));
        }
        return $hash_new;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CheckData
    public function CheckData(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        if( Route::currentRouteName() == $this->PrefixRoute.'.unActive'){
            $Pages = self::getSelectQuery( Page::where('is_active',false));
        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noAr'){
            $Pages = self::getSelectQuery(Page::whereHas('teans_ar', function ($query) {$query->where('des', null);}));

        }elseif (Route::currentRouteName() == $this->PrefixRoute.'.noEn'){
            $Pages = self::getSelectQuery(Page::whereHas('teans_en', function ($query) {$query->where('des', null);}));
        }
        return view('admin.page.index',compact('pageData','Pages'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public static function createPagesLink($lang,$pageData){
        $link = '';

        if($pageData->compound_id != null){
            $parameters = optional($pageData->project_slug)->slug.$pageData->hash;
        }else{
            $parameters = optional($pageData->loaction_slug)->slug.$pageData->hash;
        }

        $link .= LaravelLocalization::getLocalizedURL($lang, route('page_ListingPageView',$parameters));
        return $link ;
    }
}
