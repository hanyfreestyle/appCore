<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelper;
use App\Helpers\Seo\SchemaTools;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Phattarachai\LaravelMobileDetect\Agent;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;


class WebMainController extends DefaultMainController {


    public $pageView;
    public $StopeCash;

    public function __construct(
        $StopeCash = 0 ,
    )
    {
        parent::__construct();
        $this->StopeCash = $StopeCash ;


        $agent = new Agent();
        View::share('agent', $agent);

        $this->WebConfig = self::getWebConfig($this->StopeCash);
        View::share('WebConfig', $this->WebConfig);

        $this->DefPhotoList = self::getDefPhotoList($this->StopeCash);
        View::share('DefPhotoList',  $this->DefPhotoList);

        $pageView = [
            'SelMenu' => '',
            'show_fix' => true,
            'slug' => null,
            'go_home'=> null,
        ];

        $this->pageView = $pageView ;
        View::share('pageView', $pageView);

        $this->cssMinifyType = "Seo" ; # Web , WebMini , Seo
        View::share('cssMinifyType', $this->cssMinifyType);

        $this->cssReBuild = true ;
        View::share('cssReBuild', $this->cssReBuild);

        $this->printSchema = new SchemaTools();
        View::share('printSchema', $this->printSchema);


    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     printSeoMeta
    public function printSeoMeta($row,$route=null,$defPhoto="blog",$sendArr=array()){
        $lang = thisCurrentLocale();
        $type = AdminHelper::arrIsset($sendArr,'type','website');
        $ErrorPage = AdminHelper::arrIsset($sendArr,'ErrorPage',false);




        if($row->photo){
            $defImage = $row->photo ;
        }else{
            $GetdefImage = self::getDefPhotoById($defPhoto);
            $defImage =optional($GetdefImage)->photo;
        }
        if($defImage){
            $defImage = defImagesDir($defImage);
        }

        $TitleInfo =  self::TitleInfo($row,$route,$sendArr);
        $setTitle = $TitleInfo['Title'];
        $setDescription = $TitleInfo['Description'];


        SEOMeta::setTitle($setTitle);
        SEOMeta::setDescription($setDescription);


        if($ErrorPage != true){
            self::Urlinfo($row,$route);
            OpenGraph::setTitle($setTitle);
            OpenGraph::setDescription($row->translate($lang)->g_des ?? "" );
            OpenGraph::addProperty('type', $type);
            OpenGraph::setUrl(url()->current());
            OpenGraph::addImage($defImage);
            OpenGraph::setSiteName($this->WebConfig->name);

            TwitterCard::setTitle($setTitle);
            TwitterCard::setDescription($setDescription);
            TwitterCard::setUrl(url()->current());
            TwitterCard::setImage($defImage);
            TwitterCard::setImage($defImage);
            TwitterCard::setType('summary_large_image');
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   TitleInfo
    public function TitleInfo($row,$route,$sendArr){
        $sendRows = AdminHelper::arrIsset($sendArr,'sendRows',array());
        $sendRows2 = AdminHelper::arrIsset($sendArr,'sendRows2',array());

        $siteName = " | ". $this->WebConfig->name;

        switch ($route) {
            case 'page_developer_view':
                $setTitle = self::CheckMeta($row,'g_title','name').$siteName ;
                $setDescription = self::CheckMeta($row,'g_des','des');
                $xx = "1";
                break;

            case 'page_blogCatList':
                $setTitle = self::CheckMeta($row,'g_title','name').$siteName ;
                $setDescription = self::CheckMeta($row,'g_des','des');
                $xx = "2";
                break;

            case 'page_blogView':
                $setTitle = self::CheckMeta($row,'g_title','name').$siteName ;
                $setDescription = self::CheckMeta($row,'g_des','des');
                $xx = "3";
                break;

            case 'page_for_sale':
                $count = $sendRows->total() ." " . __('web/compound.h1_properties') ;
                $setTitle = self::CheckMeta($row,'g_title','name').$siteName . " ".$count ;
                $setDescription = self::CheckMeta($row,'g_des','des');
                $xx = "4";
                break;

            case 'page_compounds':
                $count = $sendRows->total() ." " . __('web/compound.h1_compounds') ." - ";
                $count .= $sendRows2->total() ." " . __('web/compound.h1_properties');
                $setTitle = self::CheckMeta($row,'g_title','name').$siteName . " ".$count ;
                $setDescription = self::CheckMeta($row,'g_des','des');
                $xx = "5";
                break;

            case 'page_ListView':
                $setTitle = self::CheckMeta($row,'g_title','name').$siteName ;
                $setDescription = self::CheckMeta($row,'g_des','des');
                $xx = "6";
                break;

            case 'page_locationView':
                $setTitle = self::CheckMeta($row,'g_title','name').$siteName ;
                $setDescription = self::CheckMeta($row,'g_des','des');
                $xx = "7";
                break;

            case 'page_ListingPageView':
                $count = $sendRows->total() ." " . __('web/compound.h1_properties') ;
                $setTitle = self::CheckMeta($row,'g_title','name').$siteName . " ".$count ;
                $setDescription = self::CheckMeta($row,'g_des','des');
                $xx = "8";
                break;

            default:
                $setTitle = ($row->g_title ?? " " )  ;
                $setDescription = ($row->g_des ?? " " ) ;


        }

        return ['Title'=>$setTitle , 'Description'=> $setDescription];
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    Urlinfo
    static function Urlinfo($row,$route){
        $lang = thisCurrentLocale();
        $alternatUrl = null;
        $pages = null;
        $property_page = null;
        $compound_page = null;

        if($lang == 'en'){
            $alternateLang = 'ar';
        }elseif ($lang == 'ar'){
            $alternateLang = 'en';
        }

        if(isset($_GET['page'])){
            $pages = "page=".$_GET['page'] ;
        }
        if(isset($_GET['property_page'])){
            $property_page = "property_page=".$_GET['property_page'] ;
        }
        if(isset($_GET['compound_page'])){
            $compound_page = "compound_page=".$_GET['compound_page'] ;
        }

        switch ($route) {
            case 'page_ContactUs':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_ContactUs')));
                $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_ContactUs')));
                break;

            case 'page_index':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_index')));
                $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_index')));
                break;

            case 'page_developers':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_developers',$pages )));
                $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_developers',$pages)));
                break;

            case 'page_developer_view':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_developer_view',$row['slug'])));
                $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_developer_view',$row['slug'])));
                break;

            case 'page_blog':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_blog',$pages)));
                $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_blog',$pages)));
                break;

            case 'page_blogCatList':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_blogCatList',$row['slug'])));
                $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_blogCatList',$row['slug'])));
                break;

            case 'page_blogView':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_blogView',[$row->getCatName->slug,$row->slug])));
                if(isset($row->translate($alternateLang)->name)){
                    $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_blogView',[$row->getCatName->slug,$row->slug])));
                }
                break;

            case 'page_for_sale':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_for_sale',$pages)));
                $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_for_sale',$pages)));
                break;

            case 'page_compounds':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_compounds',[$property_page,$compound_page])));
                $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_compounds',[$property_page,$compound_page])));
                break;

            case 'page_ListView':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_ListView',$row->slug)));
                if(isset($row->translate($alternateLang)->name)){
                    $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_ListView',$row->slug)));
                }
                break;

            case 'page_locationView':
                $Url = urldecode (LaravelLocalization::getLocalizedURL($lang,route('page_locationView',[$row->slug, $property_page,$compound_page])));
                $alternatUrl = urldecode (LaravelLocalization::getLocalizedURL($alternateLang,route('page_locationView',[$row->slug,$property_page,$compound_page])));
                break;

            case 'page_ListingPageView':
                $Url =  urldecode ( PageAdminController::createPagesLink($lang,$row));
                $alternatUrl = urldecode ( PageAdminController::createPagesLink($alternateLang,$row));
                break;

            default:

        }


        if($route != null){
            SEOMeta::addAlternateLanguage($lang, $Url);
            if($alternatUrl != null){
                SEOMeta::addAlternateLanguage($alternateLang, $alternatUrl);
            }
            SEOMeta::setCanonical($Url);
        }

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CheckMeta
    public function CheckMeta($row,$def,$other){
        if($row->$def == null){
            $meta = AdminHelper::seoDesClean($row->$other);
        }else{
            $meta = $row->$def;
        }
        return $meta ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function abortError404($from){
        $Meta =  DefaultMainController::getMeatByCatId('err_404');
        WebMainController::printSeoMeta($Meta,null,null,array('ErrorPage'=>true));
        $pageView = [
            'SelMenu' => '',
            'show_fix' => true,
            'slug' => null,
            'go_home'=> route('page_index'),
        ];
        View::share('pageView', $pageView);
        abort(404);
    }

}
