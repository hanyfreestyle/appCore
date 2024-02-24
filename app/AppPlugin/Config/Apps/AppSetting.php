<?php

namespace App\AppPlugin\Config\Apps;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;


class AppSetting extends Model implements TranslatableContract{

    use Translatable;

    protected $table = "config_app_settings";
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $translatedAttributes = ['AppName','whatsAppMessage'];
    protected $translationForeignKey = 'setting_id';




//    protected $fillable = [
//        'status','baseUrl','mobilePrefix','prefix','logo','SideLogo', 'AppName', 'ColorDark', 'ColorLight',
//        'AppBarIconColor', 'BackGroundColor',
//        'SplashColor', 'PreloadingColor','StatueBArColor', 'AppBarColor', 'AppBarColorText', 'sideMenuText', 'sideMenuColor',
//        'mainScreenScale', 'sideMenuAngle','sideMenuStyle', 'AppTheme',
//        'facebook', 'twitter', 'youtube', 'instagram', 'linkedin',
//        'whatsAppMessage','whatsAppNumber','whatsapp_key',
//        'whatsAppKey', 'telegram_key', 'telegram_group', 'telegram_phone',
//    ];





}
