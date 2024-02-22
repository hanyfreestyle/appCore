<?php

namespace App\Http\Controllers\admin\config;

use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\SettingFormRequest;
use App\Models\admin\config\Setting;
use App\Models\admin\config\SettingTranslation;
use Illuminate\Support\Facades\Cache;



class SettingsController extends AdminMainController{

    function __construct(){

        parent::__construct();
        $this->controllerName = "config";
        $this->PrefixRole = 'config';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/webConfig.app_menu');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;


        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddButToCard'=> false ,
        ];
        self::loadConstructData($sendArr);

        $this->middleware('permission:config_website', ['only' => ['webConfigEdit','webConfigUpdate']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('WebConfig_Cash');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   webConfigEdit
    public function webConfigEdit(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $setting = Setting::findOrFail(1);

        return view('admin.config.settingWeb')->with(compact('pageData','setting'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     webConfigUpdate
    public function webConfigUpdate(SettingFormRequest $request){

        $saveData= Setting::findorfail('1');
        $saveData->web_status = intval((bool) $request->input( 'web_status'));
        $saveData->fav_view = intval((bool) $request->input( 'fav_view'));

        $saveData->phone_num = $request->input( 'phone_num');
        $saveData->whatsapp_num = $request->input( 'whatsapp_num');
        $saveData->phone_call = $request->input( 'phone_call');
        $saveData->whatsapp_send = $request->input( 'whatsapp_send');
        $saveData->email = $request->input( 'email');
        $saveData->save();

        foreach ( config('app.web_lang') as $key=>$lang) {
            $saveTranslation = SettingTranslation::where('setting_id',$saveData->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key.'.name');
            $saveTranslation->closed_mass = $request->input($key.'.closed_mass');
            $saveTranslation->save();
        }

        self::ClearCash();
        return  back()->with('Edit.Done',"");
    }



}
