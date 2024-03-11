<?php

namespace App\AppPlugin\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeOptionTranslation extends Model {

    protected $table = "pro_attribute_option_translations";
    protected $fillable = ['name','slug'];
    public $timestamps = false;

}
