<?php

namespace App\AppPlugin\Product;


use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Models\ProductTranslation;
use App\AppPlugin\Product\Request\ProductRequest;
use App\Helpers\AdminHelper;

use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;


use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ShopProductController extends AdminMainController {

    use CrudTraits;


    function __construct(Product $model, ProductTranslation $translation) {
        parent::__construct();
        $this->controllerName = "Product";
        $this->PrefixRole = 'Product';
        $this->selMenu = "Shop.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_product');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $this->UploadDirIs = 'product';
        $this->translation = $translation;
        $this->translationdb = 'product_id';

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["editor" => 1, 'morePhotoFilterid' => 1],
            'yajraTable' => false,
            'AddLang' => true,
            'restore' => 1,
        ];

        self::loadConstructData($sendArr);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('CCCCCCCCCCCC');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = Product::onlyTrashed()->count();
        $rowData = self::getSelectQuery(Product::def());
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
        return view('AppPlugin.Product.form')->with([
                'pageData' => $pageData,
                'rowData' => $rowData,
                'Categories' => $Categories,
                'LangAdd' => $LangAdd,
                'selCat' => $selCat,
            ]
        );
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
        return view('AppPlugin.Product.form')->with([
                'pageData' => $pageData,
                'rowData' => $rowData,
                'Categories' => $Categories,
                'LangAdd' => $LangAdd,
                'selCat' => $selCat,
            ]
        );
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(ProductRequest $request, $id = 0) {
        $saveData = Product::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $categories = $request->input('categories');
                $saveData->is_active = intval((bool)$request->input('is_active'));

                $saveData->price = $request->input('price');
                $saveData->sale_price = $request->input('sale_price');
                $saveData->qty_left = $request->input('qty_left');
                $saveData->qty_max = $request->input('qty_max');
                $saveData->unit = $request->input('unit');
                $saveData->save();

                $saveData->categories()->sync($categories);
                self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'en.name');

                $addLang = json_decode($request->add_lang);
                foreach ($addLang as $key => $lang) {
                    $dbName = $this->translationdb;
                    $saveTranslation = $this->translation->where($dbName, $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->$dbName = $saveData->id;
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
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



//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     ListMorePhoto
//    public function ListMorePhoto($id) {
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "Edit";
//
//        $Product = Product::findOrFail($id);
//        $ProductPhotos = ProductPhoto::where('product_id', '=', $id)->orderBy('position')->get();
//        return view('admin.shop.product_photos', compact('ProductPhotos', 'pageData', 'Product'));
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     AddMorePhotos
//    public function AddMorePhotos(ProductPhotoRequest $request) {
//        $saveImgData = new PuzzleUploadProcess();
//        $saveImgData->setCountOfUpload('2');
//        $saveImgData->setUploadDirIs('product/' . $request->product_id);
//        $saveImgData->setnewFileName($request->input('name'));
//        $saveImgData->UploadMultiple($request);
//
//        foreach ($saveImgData->sendSaveData as $newPhoto) {
//            $saveData = ProductPhoto::findOrNew('0');
//            $saveData->product_id = $request->product_id;
//            $saveData->photo = $newPhoto['photo']['file_name'];
//            $saveData->photo_thum_1 = $newPhoto['photo_thum_1']['file_name'];
//            $saveData->save();
//        }
//        self::ClearCash();
//        return back()->with('Add.Done', "");
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
//    public function sortPhotoSave(Request $request) {
//        $positions = $request->positions;
//        foreach ($positions as $position) {
//            $id = $position[0];
//            $newPosition = $position[1];
//            $saveData = ProductPhoto::findOrFail($id);
//            $saveData->position = $newPosition;
//            $saveData->save();
//        }
//        self::ClearCash();
//        return response()->json(['success' => $positions]);
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     More_PhotosDestroy
//    public function More_PhotosDestroy($id) {
//        $deleteRow = ProductPhoto::findOrFail($id);
//        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
//        $deleteRow->delete();
//        self::ClearCash();
//        return back()->with('confirmDelete', "");
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     Restore
//    public function restored($id) {
//        Product::onlyTrashed()->where('id', $id)->restore();
//        self::ClearCash();
//        return back()->with('restore', "");
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
//    public function ForceDeletes($id) {
//        $deleteRow = Product::onlyTrashed()->where('id', $id)->with('more_photos')->firstOrFail();
//        if(count($deleteRow->more_photos) > 0) {
//            foreach ($deleteRow->more_photos as $del_photo) {
//                AdminHelper::DeleteAllPhotos($del_photo);
//            }
//        }
//        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
//        $deleteRow->forceDelete();
//        self::ClearCash();
//        return back()->with('confirmDelete', "");
//    }

}
