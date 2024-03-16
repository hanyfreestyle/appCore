<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Models\ProductAttribute;
use App\AppPlugin\Product\Models\ProductPhoto;
use App\AppPlugin\Product\Models\ProductTranslation;
use App\AppPlugin\Product\Request\ProductRequest;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


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
        $product = Product::where('id', $proId)->with('categories')->with('attributes')->firstOrFail();
        $product_attributes = $product->attributes->pluck('id');
        $attributes = ProductAttribute::whereNotIn('id', $product_attributes)->get();
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

}



