<?php

namespace App\AppPlugin\Config\Apps;


use Illuminate\Database\Eloquent\Model;

class AppSettingTranslation extends Model {
  public $timestamps = false;
  protected $table = "config_app_setting_translations";
  protected $fillable = [];

}
