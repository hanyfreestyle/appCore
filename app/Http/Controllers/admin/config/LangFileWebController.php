<?php

namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\LangFileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;


class LangFileWebController extends AdminMainController{

    function __construct(){
        parent::__construct();
        $this->controllerName = "weblang";
        $this->PrefixRole = 'weblang';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/core.app_menu_lang_web') ;
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddButToCard'=> false ,
        ];
        self::loadConstructData($sendArr);


        $this->middleware('permission:'.$this->PrefixRole.'_view', ['only' => ['index','updateFile']]);
        $selId = AdminHelper::arrIsset($_GET,'id','');
        View::share('selId',$selId);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #       ShowList
    public function index(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $LangMenu = config('adminLangFile.webFile');
        $AppLang =  config('app.web_lang');
        $rowData = LangFileController::getDataTableLang($LangMenu,$AppLang);

        return view('admin.config.lang.web_index')->with(
            [
                'pageData'=>$pageData,
                'rowData'=>$rowData,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function EditLang(){
        $listFile =  config('adminLangFile.webFile');

        $mergeData = [];
        $allData = [];
        $prefixCopy = "";
        $ViewData = 0;
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        if(isset($_GET['id']) and isset($listFile[$_GET['id']])){
            $ViewData = '1';
            $id = trim($_GET['id']);
            $prefixCopy = LangFileController::getPrefixCopy($listFile[$id]);

            foreach ( config('app.web_lang') as $key=>$lang) {
                $FullPathToFile  = LangFileController::getFullPathToFileArr($listFile[$id],$key);
                $GetData = File::getRequire($FullPathToFile);
                $result = array();

                foreach ($GetData as $Mainkey => $value) {

                    if (is_array($value)) {

                        $newSubArr = [];
                        foreach ($value as $subKey => $subvalue){
                            $newSubArr += [$Mainkey."_".$subKey => $subvalue ];
                        }
                        $result = array_merge($result, $newSubArr);
                    }
                    else {
                        $result[$Mainkey] = $value;
                    }
                }
                $allData += [$key=>$result] ;
                $mergeData = array_merge($mergeData,$result);

            }
        }
        ksort($mergeData);

        return view('admin.config.lang.web_edit')->with(
            [
                'pageData'=>$pageData,
                'mergeData'=>$mergeData,
                'allData'=>$allData,
                'prefixCopy'=>$prefixCopy,
                'ViewData'=>$ViewData,
            ]
        );

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     updateFile
    public function updateFile(LangFileRequest $request){

        $id = $request->file_id ;
        $listFile =  config('adminLangFile.webFile');

        $contentAsArr =[];
        $breaks = array("<br />","<br>","<br/>",'\r\n');
        foreach ( config('app.web_lang') as $key=>$lang){
            $FullPathToFile = LangFileController::getFullPathToFileArr($listFile[$id], $key);
            $content = "<?php\n\nreturn\n[\n";
            $index = 0;
            foreach ($request->key as $keyfromrequest ){
                if(trim($keyfromrequest) != ''){
                    $keyfromrequest = AdminHelper::Url_Slug($keyfromrequest,['delimiter'=>'_']);
                    $contentAsArr += [$keyfromrequest => $request->$key[$index]];
                    $content .= "\t'".$keyfromrequest."' => '".htmlentities(preg_replace("/\r\n|\r|\n/", '&lt;br&gt;', $request->$key[$index]))."',\n";
                }
                $index++ ;
            }
            $content .= "];";
            File::put($FullPathToFile,$content);
        }
        return  back()->with('Update.Done','');
    }

}
