<?php
use App\Http\Controllers\WebMainController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    defWebAssets
if (!function_exists('defWebAssets')) {
    function defWebAssets($path, $secure = null): string{
        return app('url')->asset('assets/web/' . $path, $secure);
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    underAssets
if (!function_exists('underAssets')) {
    function underAssets($path, $secure = null): string{
        return app('url')->asset('assets/under/' . $path, $secure);
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getPhotoPath
if (!function_exists('getPhotoPath')) {
    function getPhotoPath($file,$defPhoto="dark_logo",$defPhotoThum="photo"){
        $defPhoto_file = WebMainController::getDefPhotoById($defPhoto);
        if($file){
            $sendImg = defImagesDir($file);
        }else{
            $sendImg = defImagesDir($defPhoto_file->$defPhotoThum ?? '');
        }
        return $sendImg ;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    getDefPhotoPath
if (!function_exists('getDefPhotoPath')) {
    function getDefPhotoPath($DefPhotoList,$cat_id,$defPhotoThum="photo"){
        if ($DefPhotoList->has($cat_id)) {
            $file =  $DefPhotoList[$cat_id][$defPhotoThum] ;
            $sendImg = defImagesDir($file);
        }else{
            $sendImg = ""  ;
        }
        return $sendImg ;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     webChangeLocale
if (!function_exists('webChangeLocale')) {
    function webChangeLocale(){
        $Current =  LaravelLocalization::getCurrentLocale() ;
        if($Current == 'ar'){
            $change = 'en';
        }else{
            $change = 'ar';
        }
        return $change;
    }
}
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     webChangeLocaletext
if (!function_exists('webChangeLocaletext')) {
    function webChangeLocaletext(){
        $Current =  LaravelLocalization::getCurrentLocale() ;
        if($Current == 'ar'){
            $change = 'English';
        }else{
            $change = 'عربى';
        }
        return $change;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     GetCopyRight
if (!function_exists('GetCopyRight')) {
    function GetCopyRight($StartDate,$CompanyName) {
        if($StartDate > date("Y")) {
            $StartDate = date("Y");
        }
        $Lang =  LaravelLocalization::getCurrentLocale() ;
        switch($Lang) {
            case 'ar':
                $copyname = "جميع الحقوق محفوظة";
                if($StartDate == date("Y")) {
                    $CopyRight = $copyname." &copy; ".date("Y").' <span class="clr-tertiary-300">'.$CompanyName.'</span>';
                } else {
                    $CopyRight = $copyname. '<span class="En_Font footerYears">'." &copy; ".$StartDate." - ".date("Y")
                        .'</span> <span class="clr-tertiary-300">' .$CompanyName.'</span>';
                }
                break;
            default:
                $copyname = "All Rights Reserved";
                if($StartDate == date("Y")) {
                    $CopyRight = $copyname." &copy; ".date("Y").' <span class="clr-tertiary-300">'.$CompanyName.'</span>';
                } else {
                    $CopyRight = $copyname." &copy; ".$StartDate." - ".date("Y").' <span class="clr-tertiary-300">'
                        .$CompanyName.'</span>';
                }
        }
        return $CopyRight;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ChangeText
if (!function_exists('ChangeText')) {
    function ChangeText($value) {
        $WebConfig = WebMainController::getWebConfig();
        $CompanyName = '<span>'.$WebConfig->name.'</span>';
        $rep1 = array("[CompanyName]","[WebSiteName]");
        $rep2 = array($CompanyName,$WebConfig->def_url);
        $value = str_replace($rep1,$rep2,$value);
        return $value;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getLocationProjectTypeName
if (!function_exists('getLocationProjectTypeName')) {
    function getLocationProjectTypeName($value) {
        switch ($value) {
            case 'compound':
                $sendStyle = __('web/var.location_compound');
                break;
            case 'village':
                $sendStyle = __('web/var.location_village');
                break;
            case 'resort':
                $sendStyle = __('web/var.location_resort');
                break;
            default:
                $sendStyle = "";
        }
        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getProjectStatus
if (!function_exists('getProjectStatus')) {
    function getProjectStatus($value) {
        switch ($value) {
            case 'under-construction':
                $sendStyle =__('web/var.status_under_construction');
                break;
            case 'completed':
                $sendStyle = __('web/var.status_completed');
                break;
            default:
                $sendStyle = "";
        }
        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getProjectTypeName
if (!function_exists('getProjectTypeName')) {
    function getProjectTypeName($value) {
        switch ($value) {
            case 'residential':
                $sendStyle = __('web/var.project_residential');
                break;
            case 'vacation':
                $sendStyle = __('web/var.project_vacation');
                break;
            case 'commercial':
                $sendStyle = __('web/var.project_commercial');
                break;
            case 'medical':
                $sendStyle =__('web/var.project_medical');
                break;

            default:
                $sendStyle = "";
        }
        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getPropertyTypeName
if (!function_exists('getPropertyTypeName')) {
    function getPropertyTypeName($value) {
        switch ($value) {
            case 'apartment':
                $sendStyle = __('web/var.units_apartment') ;
                break;
            case 'duplex':
                $sendStyle = __('web/var.units_duplex') ;
                break;
            case 'studio':
                $sendStyle = __('web/var.units_studio') ;
                break;
            case 'town-house':
                $sendStyle = __('web/var.units_town_house') ;
                break;
            case 'twin-house':
                $sendStyle = __('web/var.units_twin_house') ;
                break;
            case 'pent-house':
                $sendStyle = __('web/var.units_pent_house') ;
                break;
            case 'villa':
                $sendStyle = __('web/var.units_villa') ;
                break;
            case 'office':
                $sendStyle = __('web/var.units_office') ;
                break;
            case 'store':
                $sendStyle = __('web/var.units_store') ;
                break;
            case 'chalet':
                $sendStyle = __('web/var.units_chalet') ;
                break;
            case 'chalet-with-garden':
                $sendStyle = __('web/var.units_chalet_with_garden') ;
                break;
            case 'pharmacy':
                $sendStyle = __('web/var.units_pharmacy') ;
                break;
            case 'clinic':
                $sendStyle = __('web/var.units_clinic') ;
                break;
            case 'laboratory':
                $sendStyle = __('web/var.units_laboratory') ;
                break;

            default:
                $sendStyle = "";
        }
        return $sendStyle;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # activeMenu
    if (!function_exists('activeMenu')) {
        function activeMenu($pageView, $current){
            if(isset($pageView['SelMenu']) and $pageView['SelMenu'] == $current ){
                return " current-page ";
            }else{
                return null;
            }
        }
    }


}
