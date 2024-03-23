<?php

namespace App\AppPlugin\Product;


use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Models\Attribute;
use App\AppPlugin\Product\Models\AttributeValue;
use App\AppPlugin\Product\Models\ProductAttribute;
use App\AppPlugin\Product\Models\ProductPhoto;
use App\AppPlugin\Product\Models\ProductTranslation;

use App\AppPlugin\Product\Models\ProductVariants;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


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

        $product = Product::where('id', $proId)->firstOrFail();
        $productAttr = ProductAttribute::where('product_id', $proId)->get();

        $attributeValues = [];
        foreach ($productAttr as $key => $attr) {
            if($attr->values){
                $thisAttrVaIds  =  json_decode($attr->values, true) ;
                $attributeValues[] = AttributeValue::whereIn('id', $thisAttrVaIds)->get();
            }
        }

        $attributeValues = $this->get_combinations($attributeValues);

        $attributeValue =  AttributeValue::get()->keyBy('id')->toArray();

       return view('AppPlugin.Product.manage-variants', compact('pageData', 'product','attributeValues','attributeValue'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function get_combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = $result_item + array(uniqid() => $property_value->id);
                }
            }
            $result = $tmp;
        }
        return $result;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UpdateVariants

    public function UpdateVariants(Request $request) {
        $product = Product::findOrFail($request->proId);
        $variantList = $request->input('product_variants');
//        dd($variantList);

        foreach ($variantList as $key => $list) {
            if ($list['price'] > 0) {
                $data = [];
                sort($list['variants']);
                sort($list['variants_id']);
                $variants_slug = implode('-', $list['variants']);
                $variants_slug_id = implode('-', $list['variants_id']);
                $variants_string = implode(', ', $list['variants']);
//                if ($request->hasFile('product_image')) {
//                    if (array_key_exists($key, $request->file('product_image'))) {
//                        $file = $request->file('product_image')[$key];
//                        $filename = $variants_slug . '-' . time() * time() . '.' . $file->getClientOriginalExtension();
//                        $file->move(public_path('/upload'), Str::slug($filename));
//                        $data['image'] = Str::slug($filename);
//                    }
//                }

                $data['product_id'] = $product->id;
                $data['variants_string'] = $variants_string;
                $data['variants_slug'] = $variants_slug;
                $data['variants_slug_id'] = $variants_slug_id;
                $data['price'] = $list['price'];
                ProductVariants::updateOrCreate(['product_id' => $product->id, 'variants_slug' => $variants_slug], $data);
            }
        }
        return back()->withSuccess("Updated Successful.");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function ManageVariantsCCCCCCCCCCCCC(Request $request) {

        $product = Product::findOrFail($request->id);
        $ProductVariant = ProductVariant::where('product_id', $product->id)->orderBy('id', 'DESC')->get();
        $productAttr = ProductAttribute::where('product_id', $request->id)->get();

        $attributeValues = [];
        foreach ($productAttr as $key => $attr) {
            $attributeValues[] = AttributeValue::where('attribute_id', $attr->attribute_id)->get();
        }

        $attributeValues = $this->get_combinations($attributeValues);
//        dd($attributeValues);

        $attributeValue =  AttributeValue::get()->keyBy('id')->toArray();


        return view('admin.ManageVariants', compact('product', 'attributeValues','ProductVariant','attributeValue'));
    }


//    public function ManageVariants($proId){
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "Edit";
//
//        $product = Product::where('id', $proId)->with('variants')->firstOrFail();
//
//
//        foreach ($product->variants as $variant){
//
//
//
//            echobr($variant->id);
//            foreach ( $variant->attributeName as $attributeName) {
//
//                foreach ( $variant->valueName as $valueName) {
//
////                    echobr($valueName->name);
//                }
//            }
//        }
//
////        $arr1 = array(1,2,3);
////        $arr2 = array(4,5);
////        $ddd = Arr::crossJoin($arr1,$arr2);
////        dd($ddd);
//
//
////        $product = Product::where('id', $proId)->with('attributes')->firstOrFail();
////        $thisattributes =$product->attributes->pluck('id');
////
////        foreach ($product->attributes as $attribute){
////            foreach ($attribute->values as $value){
////
////                if (in_array($value->id, json_decode($attribute->pivot->values, true))) {
////                    echobr($value->name ." ".$value->id);
////                }
////            }
////        }
//
//        // return view('AppPlugin.Product.manage-variants', compact('pageData', 'product'));
//    }
}



