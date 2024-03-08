<?php

use App\Models\admin\config\UploadFilter;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    defAdminAssets
if(!function_exists('defAdminAssets')) {
    function defAdminAssets($path, $secure = null): string {
        return app('url')->asset('assets/admin/' . $path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    defImagesDir
if(!function_exists('defImagesDir')) {
    function defImagesDir($path, $secure = null): string {
        return app('url')->asset($path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    PdfAssets
if(!function_exists('PdfAssets')) {
    function PdfAssets($path, $secure = null): string {
        return app('url')->asset('assets/pdf/' . $path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    PdfAssets
if(!function_exists('flagAssets')) {
    function flagAssets($path, $secure = null): string {
        return app('url')->asset('assets/flag/' . $path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Update_createDirectory
if(!function_exists('Update_createDirectory')) {
    function Update_createDirectory($uploadDir) {
        $fullPath = $uploadDir;
        if(!File::isDirectory($fullPath)) {
            File::makeDirectory($fullPath, 0777, true, true);
        }
        return $uploadDir;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  IsMenuView
if(!function_exists('IsMenuView')) {
    function IsMenuView($Arr, $Name, $fileName = null, $DefVall = true) {
        if($fileName != null) {
            $filePath = base_path('routes/AppPlugin/' . $fileName);

            if(!file_exists($filePath)) {
                $DefVall = false;
            }
        }
        if(isset($Arr[$Name])) {
            $SendVal = $Arr[$Name];
        } else {
            $SendVal = $DefVall;
        }
        return $SendVal;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  IsArr
if(!function_exists('IsArr')) {
    function IsArr($Arr, $Name, $DefVall = true) {
        if(isset($Arr[$Name])) {
            $SendVal = $Arr[$Name];
        } else {
            $SendVal = $DefVall;
        }
        return $SendVal;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  issetArr
if(!function_exists('issetArr')) {
    function issetArr($Arr, $Name, $DefVall = "") {
        if(isset($Arr[$Name])) {
            $SendVal = $Arr[$Name];
        } else {
            $SendVal = $DefVall;
        }
        return $SendVal;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   cashDay
if(!function_exists('cashDay')) {
    function cashDay($days = 2) {
        $lifeTime = $days * (86400);
        return $lifeTime;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    thisCurrentLocale
if(!function_exists('thisCurrentLocale')) {
    function thisCurrentLocale() {
        return LaravelLocalization::getCurrentLocale();
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getRoleName
if(!function_exists('getRoleName')) {
    function getRoleName() {
        if(thisCurrentLocale() == 'ar') {
            $sendName = "name_ar";
        } else {
            $sendName = "name_en";
        }
        return $sendName;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getRoleName
if(!function_exists('printLang')) {
    function printLang($sendLang) {
        $sendLang = str_replace("&amp;lt;br&amp;gt;", "\n", $sendLang);
        return nl2br($sendLang);
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getRoleName
if(!function_exists('getColLang')) {
    function getColLang($crunt, $willBe = null) {
        if(count(config('app.web_lang')) >= 2) {
            $send = $crunt;
        } else {
            if($willBe != null) {
                $send = $willBe;
            } else {
                $send = $crunt * 2;
            }
        }
        return $send;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     printLableKey
if(!function_exists('printLableKey')) {
    function printLableKey($key) {
        if(count(config('app.web_lang')) > 1) {
            $send = '(' . $key . ')';
        } else {
            $send = "";
        }
        return $send;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     DefCategoryTextName
if(!function_exists('DefCategoryTextName')) {
    function DefCategoryTextName($key) {
        if($key) {
            $send = $key;
        } else {
            $send = __('admin/proProduct.cat_text_name');
        }
        return $send;
    }
}



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    defAdminAssets
if(!function_exists('isSetKeyForLang')) {
    function isSetKeyForLang($key) {
        if(isset($_GET['key']) and $_GET['key'] == $key) {
            return "ThisSelectLang";
        } else {
            return '';
        }

    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # printCategoryName
if(!function_exists('printCategoryName')) {
    function printCategoryName($key, $row, $url) {
        if($row->children_count > 0) {
            if(isset($row->translate($key)->name)) {
                return '<a href="' . route($url, $row->id) . '">' . $row->translate($key)->name . ' (' . $row->children_count . ')</a>';
            } else {
                return null;
            }
        } else {
            return $row->translate($key)->name ?? '';
        }
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   printUploadNotes
if(!function_exists('printUploadNotes')) {
    function printUploadNotes($thisfilterid) {
        if(config('app.upload_photo_notes') == true and intval($thisfilterid) != 0) {
            $notesSend = UploadFilter::where('id', $thisfilterid)->first();
            $printName = "notes_" . thisCurrentLocale();
            return $notesSend->$printName;
        }
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CheckDateFormat
if(!function_exists('CheckDateFormat')) {
    function CheckDateFormat($value) {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value)) {
            $dateValue =  Carbon::parse($value)->format("Y-m-d");
        } else {
            $dateValue = $value ;
        }
        return $dateValue ;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   SaveDateFormat
if(!function_exists('SaveDateFormat')) {
    function SaveDateFormat($request,$name) {
        if($request->input($name) == null){
            $dateValue =  Carbon::parse(now())->format("Y-m-d");
        }else{
            $dateValue =  Carbon::parse($request->input($name))->format("Y-m-d");
        }
        return $dateValue ;
    }
}



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #


?>
