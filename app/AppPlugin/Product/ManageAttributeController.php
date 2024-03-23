<?php

namespace App\AppPlugin\Product;


use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Models\Attribute;
use App\AppPlugin\Product\Models\AttributeValue;
use App\AppPlugin\Product\Models\ProductAttribute;
use App\AppPlugin\Product\Models\ProductPhoto;
use App\AppPlugin\Product\Models\ProductTranslation;

use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class ManageAttributeController extends AdminMainController {

    use CrudTraits;

    function __construct(Product $model, ProductTranslation $translation, ProductPhoto $modelPhoto) {
        parent::__construct();
        $this->controllerName = "Product";
        $this->PrefixRole = 'Product';
        $this->selMenu = "Shop.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_product');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;
        $this->modelPhoto = $modelPhoto;
        $this->modelPhotoColumn = 'product_id';

        $this->UploadDirIs = 'product';
        $this->translation = $translation;
        $this->translationdb = 'product_id';

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["editor" => 1, 'morePhotoFilterid' => 1],
            'yajraTable' => true,
            'AddLang' => true,
            'restore' => 1,
            'formName' => "ProductFilters",
        ];

        self::loadConstructData($sendArr);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    ManageAttribute
    public function ManageAttribute($proId) {

        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $product = Product::where('id', $proId)->with('attributes')->firstOrFail();
        $product_attributes = $product->attributes->pluck('id');
        $attributes = Attribute::whereNotIn('id', $product_attributes)->with('values')->get();

        return view('AppPlugin.Product.manage-attribute', compact('pageData', 'product', 'attributes'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ManageAttributeUpdate
    public function ManageAttributeUpdate(Request $request, $proId) {
        $product = Product::where('id', $proId)->firstOrFail();
        $attributes = $request->input('attributes');
        $product->attributes()->attach($attributes);
        $product->save();
        return back()->with('data_not_save', "");
   }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function RemoveAttribute($proId, $AttributeId) {
        $product = Product::where('id', $proId)->firstOrFail();
        $product->attributes()->detach($AttributeId);
        return back()->with('data_not_save', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ManageAttributeValueUpdate(Request $request,$id){

        $update = ProductAttribute::where('id',$id)->firstOrFail();
        $update->values = $request->attributes_values;
        $update->save();
        return back()->with('data_not_save', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ManageVariants($proId){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $product = Product::where('id', $proId)->with('variants')->firstOrFail();


        foreach ($product->variants as $variant){



            echobr($variant->id);
            foreach ( $variant->attributeName as $attributeName) {

                foreach ( $variant->valueName as $valueName) {

//                    echobr($valueName->name);
                }
            }
        }

//        $arr1 = array(1,2,3);
//        $arr2 = array(4,5);
//        $ddd = Arr::crossJoin($arr1,$arr2);
//        dd($ddd);


//        $product = Product::where('id', $proId)->with('attributes')->firstOrFail();
//        $thisattributes =$product->attributes->pluck('id');
//
//        foreach ($product->attributes as $attribute){
//            foreach ($attribute->values as $value){
//
//                if (in_array($value->id, json_decode($attribute->pivot->values, true))) {
//                    echobr($value->name ." ".$value->id);
//                }
//            }
//        }

      // return view('AppPlugin.Product.manage-variants', compact('pageData', 'product'));
    }

}



