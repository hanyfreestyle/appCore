<?php

namespace App\AppPlugin\Product\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;



class ProductAttribute extends Model {

    protected $table = "pro_product_attribute";
    protected $primaryKey = 'id';
    public $timestamps = false;

//    protected $casts = [
//        'values' => 'array'
//    ];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     values
//    protected function values() :Attribute{
//        return Attribute::make (
//            get: fn($value) => json_decode($value,true),
//            set: fn($value) => json_encode($value)
//        );
//    }

}



