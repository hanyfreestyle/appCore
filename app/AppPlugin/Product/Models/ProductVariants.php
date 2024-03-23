<?php

namespace App\AppPlugin\Product\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ProductVariants extends Model {


    protected $table = "pro_product_variants";
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

    public function mainPro(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     scopeRoot

//    public function product(): BelongsTo {
//        return $this->belongsTo(Product::class);
//    }
//
//
//
//    public function attributeName()   {
//        return $this->belongsToMany(Attribute::class,'pro_product_variant_attribute','variant_id','attribute_id')->with('translation');
//    }
//
//    public function valueName()   {
//        return $this->belongsToMany(AttributeValue::class,'pro_product_variant_attribute','variant_id','value_id')->with('translation');
//    }

//    public function valueName()   {
//        return $this->hasMany(AttributeValue::class,'pro_product_variant_attribute','id','value_id')->with('translation');
//    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


}



