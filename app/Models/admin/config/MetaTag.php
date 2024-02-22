<?php

namespace App\Models\admin\config;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaTag extends Model implements TranslatableContract
{
    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['g_title','g_des'];
    protected $fillable = ['cat_id'];
    protected $table = "meta_tags";
    protected $primaryKey = 'id';

}
