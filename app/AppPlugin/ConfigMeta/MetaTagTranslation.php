<?php

namespace App\AppPlugin\ConfigMeta;

use Illuminate\Database\Eloquent\Model;

class MetaTagTranslation extends Model{
    public $timestamps = false;
    protected $table = "config_meta_tag_translations";
    protected $fillable = ['g_title','g_des'];
}
