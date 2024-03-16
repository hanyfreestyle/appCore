<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\Product;
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


class ShopProductController extends AdminMainController {

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

        $ProductType_Arr = [
            "1"=> ['id'=>'1','name'=> __('admin/proProduct.pro_type_1') ],
            "2"=> ['id'=>'2','name'=> __('admin/proProduct.pro_type_2') ],
        ];
        View::share('ProductType_Arr', $ProductType_Arr);

        $OnStock_Arr = [
            "1"=> ['id'=>'0','name'=> __('admin/proProduct.pro_status_stock_0') ],
            "2"=> ['id'=>'1','name'=> __('admin/proProduct.pro_status_stock_1') ],
        ];
        View::share('OnStock_Arr', $OnStock_Arr);


        $this->CashBrandList = self::CashBrandList($this->StopeCash);
        View::share('CashBrandList', $this->CashBrandList);

        $this->CashCategoriesList = self::CashCategoriesList($this->StopeCash);
        View::share('CashCategoriesList', $this->CashCategoriesList);


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('CCCCCCCCCCCC');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(Request $request) {
//        $allPro = Product::all();
//        foreach ($allPro as $pro){
//            if(intval($pro->children) == 0){
//                $pro->type = 1;
//            }else{
//                $pro->type = 2;
//            }
//            $pro->save();
//        }

        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = Product::onlyTrashed()->count();
        $session = self::getSessionData($request);

        if($session == null) {
            $rowData = self::getSelectQuery(Product::def());
        } else {
            $rowData = self::getSelectQuery(self::ProductFilterQ(Product::def(), $session));
        }


        return view('AppPlugin.Product.index', compact('pageData', 'rowData'));
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $pageData['SubView'] = false;
        $rowData = self::getSelectQuery(Product::onlyTrashed());
        return view('AppPlugin.Product.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SubCategory
    public function ListCategory($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = true;
        $Category = Category::findOrFail($id);
        $rowData = Product::def()->whereHas('categories', function ($query) use ($id) {
            $query->where('category_id', $id);
        })->paginate(10);
        return view('AppPlugin.Product.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $Categories = Category::all();
        $rowData = Product::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();
        $selCat = [];
        return view('AppPlugin.Product.form', compact('pageData', 'rowData', 'Categories', 'LangAdd', 'selCat'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $Categories = Category::all();
        $rowData = Product::where('id', $id)->with('categories')->firstOrFail();
        $selCat = $rowData->categories()->pluck('category_id')->toArray();
        $LangAdd = self::getAddLangForEdit($rowData);
        return view('AppPlugin.Product.form', compact('pageData', 'rowData', 'Categories', 'LangAdd', 'selCat'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(ProductRequest $request, $id = 0) {
        $saveData = Product::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $categories = $request->input('categories');
                $saveData->is_active = $request->input('is_active');
                $saveData->on_stock = $request->input('on_stock');
                $saveData->type = $request->input('type');
                $saveData->brand_id = $request->input('brand_id');

                $saveData->price = $request->input('price');
                $saveData->regular_price = $request->input('regular_price');
                $saveData->qty_left = $request->input('qty_left');
                $saveData->qty_max = $request->input('qty_max');
                $saveData->save();

                $saveData->categories()->sync($categories);
                self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'en.name');

                $addLang = json_decode($request->add_lang);
                foreach ($addLang as $key => $lang) {
                    $dbName = $this->translationdb;
                    $saveTranslation = $this->translation->where($dbName, $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->$dbName = $saveData->id;
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation->short_des = $request->input($key . '.short_des');
                    $saveTranslation = self::saveTranslationMain($saveTranslation, $key, $request);
                    $saveTranslation->save();
                }
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeleteException($id) {
        $deleteRow = Product::onlyTrashed()->where('id', $id)->with('more_photos')->firstOrFail();
        if(count($deleteRow->more_photos) > 0) {
            foreach ($deleteRow->more_photos as $del_photo) {
                AdminHelper::DeleteAllPhotos($del_photo);
            }
        }
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        AdminHelper::DeleteDir($this->UploadDirIs, $id);
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ProductFilterQ
    static function ProductFilterQ($query, $session, $order = null) {

        $query->where('id', '!=', 0);

        if(isset($session['from_date']) and $session['from_date'] != null) {
            $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if(isset($session['to_date']) and $session['to_date'] != null) {
            $query->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
        }

        if(isset($session['is_active']) and $session['is_active'] != null) {
            $query->where('is_active', $session['is_active']);
        }
        if(isset($session['type']) and $session['type'] != null) {
            $query->where('type', $session['type']);
        }
        if(isset($session['brand_id']) and $session['brand_id'] != null) {
            $query->where('brand_id', $session['brand_id']);
        }

        if(isset($session['cat_id']) and $session['cat_id'] != null) {
            $id = $session['cat_id'];
            $query->whereHas('categories', function ($query) use ($id) {
                $query->where('category_id', $id);
            });
        }

        if($order != null) {
            $orderBy = explode("|", $order);
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        return $query;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCountryList
    static function CashBrandList($stopCash=0){
        if($stopCash){
            $CashBrandList = Brand::CashBrandList();
        }else{
            $CashBrandList = Cache::remember('CashBrandList',cashDay(7), function (){
                return Brand::CashBrandList();
            });
        }
        return $CashBrandList ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCountryList
    static function CashCategoriesList($stopCash=0){
        if($stopCash){
            $CashCategoriesList = Category::CashCategoriesList();
        }else{
            $CashCategoriesList = Cache::remember('CashCategoriesList',cashDay(7), function (){
                return Category::CashCategoriesList();
            });
        }
        return $CashCategoriesList ;
    }
}



