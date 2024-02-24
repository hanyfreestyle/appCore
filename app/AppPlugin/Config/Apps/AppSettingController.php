<?php

namespace App\AppPlugin\Config\Apps;

use App\Http\Controllers\AdminMainController;


use App\Models\admin\config\Setting;
use App\Models\admin\config\SettingTranslation;
use Illuminate\Support\Facades\Cache;

class AppSettingController extends AdminMainController{

    function __construct(){

        parent::__construct();
        $this->controllerName = "AppSetting";
        $this->PrefixRole = 'AppSetting';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/apps.menu_app_setting');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;


        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddButToCard'=> false ,
        ];
        self::loadConstructData($sendArr);


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash(){
        Cache::forget('XXXXXXXXXXXXXXXX');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   webConfigEdit
    public function AppSetting(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $setting = AppSetting::findOrFail(1);

        return view('AppPlugin.ConfigApp.setting')->with(compact('pageData','setting'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function AppSettingUpdate(AppSettingRequest $request){


        $saveData= AppSetting::findorfail('1');
        $saveData->status = intval((bool) $request->input( 'status'));
        $saveData->baseUrl = $request->input( 'baseUrl');
        $saveData->mobilePrefix = $request->input( 'mobilePrefix');
        $saveData->prefix = $request->input( 'prefix');

        $saveData->ColorDark = $request->input( 'ColorDark');
        $saveData->ColorLight = $request->input( 'ColorLight');
        $saveData->AppBarIconColor = $request->input( 'AppBarIconColor');
        $saveData->BackGroundColor = $request->input( 'BackGroundColor');
        $saveData->SplashColor = $request->input( 'SplashColor');
        $saveData->PreloadingColor = $request->input( 'PreloadingColor');
        $saveData->StatueBArColor = $request->input( 'StatueBArColor');
        $saveData->AppBarColor = $request->input( 'AppBarColor');
        $saveData->AppBarColorText = $request->input( 'AppBarColorText');
        $saveData->sideMenuText = $request->input( 'sideMenuText');
        $saveData->sideMenuColor = $request->input( 'sideMenuColor');
        $saveData->mainScreenScale = $request->input( 'mainScreenScale');
        $saveData->sideMenuAngle = $request->input( 'sideMenuAngle');
        $saveData->sideMenuStyle = $request->input( 'sideMenuStyle');
        $saveData->AppTheme = $request->input( 'AppTheme');

        $saveData->facebook = $request->input( 'facebook');
        $saveData->youtube = $request->input( 'youtube');
        $saveData->twitter = $request->input( 'twitter');
        $saveData->instagram = $request->input( 'instagram');
        $saveData->linkedin = $request->input( 'linkedin');

        $saveData->whatsAppNumber = $request->input( 'whatsAppNumber');
        $saveData->whatsAppKey = $request->input( 'whatsAppKey');
        $saveData->telegram_key = $request->input( 'telegram_key');
        $saveData->telegram_group = $request->input( 'telegram_group');
        $saveData->telegram_phone = $request->input( 'telegram_phone');

        $saveData->save();

        foreach ( config('app.web_lang') as $key=>$lang) {
            $saveTranslation = AppSettingTranslation::where('setting_id',$saveData->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->setting_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->whatsAppMessage = $request->input($key.'.whatsAppMessage');
            $saveTranslation->AppName = $request->input($key.'.AppName');
            $saveTranslation->save();
        }
        self::ClearCash();
        return redirect()->back();
    }



/*
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function AppSetting()
    {
        $setting = AppSetting::findOrFail(1);
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=>__('admin/menu.setting_web'),
        ];
        return view('admin.app.setting_form')->with(compact('pageData','setting'));
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     AppPhotos
    public function AppPhotos()
    {
        $setting = AppSetting::findOrFail(1);
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=>__('admin/menu.setting_web'),
        ];
        return view('admin.app.photos_form')->with(compact('pageData','setting'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AppProfile
    public function AppProfile()
    {
        $menu = AppMenu::where('type','user')->firstOrFail();
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=>__('admin/menu.app_setting'),
            'cardTitle'=>__('admin/menu.app_profile'),
            'route'=> route('App.AppProfileUpdate'),
        ];
        return view('admin.app.profile_form')->with(compact('pageData','menu'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # AppCart
    public function AppCart()
    {
        $menu = AppMenu::where('type','cart')->firstOrFail();
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=>__('admin/menu.app_setting'),
            'cardTitle'=>__('admin/menu.app_cart'),
            'route'=> route('App.AppProfileUpdate'),
        ];
        return view('admin.app.profile_form')->with(compact('pageData','menu'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function AppProfileUpdate(AppMenuRequest $request)
    {
        // $menu = AppMenu::where('type','profile')->firstOrFail();

        $id = $request->input('id');
        $menu = AppMenu::findOrFail($id);

        foreach ( config('app.shop_lang') as $key=>$lang) {
            $saveTranslation = AppMenuTranslation::where('menu_id',$menu->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->menu_id = $menu->id;
            $saveTranslation->locale = $key;
            $saveTranslation->url = $request->input($key.'.url');
            $saveTranslation->label  = $request->input($key.'.label');
            $saveTranslation->icon = $request->input($key.'.icon');
            $saveTranslation->title = intval((bool) $request->input( 'title'));
            $saveTranslation->save();
        }

        return redirect()->back();

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     AppProfile
    public function AppMenuList()
    {
        $menus = AppMenu::where('type','side')->orderBy('postion')->paginate(20);
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=>__('admin/menu.app_setting'),
            'cardTitle'=>__('admin/menu.app_menu'),
        ];
        return view('admin.app.menu_index')->with(compact('pageData','menus'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $menu = AppMenu::findOrNew(0);
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=>__('admin/menu.app_setting'),
            'cardTitle'=>__('admin/menu.app_menu'),
            'route'=> route('App.AppMenuList.update',intval($menu->id)),
        ];
        return view('admin.app.profile_form')->with(compact('pageData','menu'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function edit($id)
    {
        $menu = AppMenu::findOrNew($id);
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=>__('admin/menu.app_setting'),
            'cardTitle'=>__('admin/menu.app_menu'),
            'route'=> route('App.AppMenuList.update',intval($menu->id)),
        ];
        return view('admin.app.profile_form')->with(compact('pageData','menu'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function storeUpdate(AppMenuRequest $request)
    {

        $id = $request->input('id');
        $menu = AppMenu::findOrNew($id);
        $menu->type = 'side';
        $menu->save();

        foreach ( config('app.shop_lang') as $key=>$lang) {
            $saveTranslation = AppMenuTranslation::where('menu_id',$menu->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->menu_id = $menu->id;
            $saveTranslation->locale = $key;
            $saveTranslation->url = $request->input($key.'.url');
            $saveTranslation->label  = $request->input($key.'.label');
            $saveTranslation->icon = $request->input($key.'.icon');
            $saveTranslation->title = intval((bool) $request->input( 'title'));
            $saveTranslation->save();
        }

        return redirect()->route('App.AppMenuList.index');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {
        $deleteRow = AppMenu::findOrFail($id);
        $deleteRow->delete();
        return back()->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategorySort
    public function Sort()
    {

        $menus = AppMenu::where('type','side')->orderBy('postion')->get();
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=>__('admin/menu.app_setting'),
            'cardTitle'=>__('admin/menu.app_menu'),
        ];

        return view('admin.app.menu_sort',compact('pageData','menus'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategorySaveSort
    public function SaveSort(Request $request){
        $positions = $request->positions;
        foreach($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData =  AppMenu::findOrFail($id) ;
            $saveData->postion = $newPosition;
            $saveData->save();
        }

        return response()->json(['success'=>$positions]);
    }

*/














}
