<?php

namespace App\AppPlugin\Product;

use App\Helpers\AdminHelper;

use App\Http\Controllers\AdminMainController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class ShopProductController extends AdminMainController {
    public $controllerName;
    public $PageTitle;
    public $selMenu;
    public $PrefixRole;
    public $PrefixRoute;
    public $pageData;

    function __construct(
        $selMenu = 'Shop.',
        $controllerName = 'ShopProduct',
        $PrefixRole = 'shopProduct',
        $PrefixRoute = '#',
        $pageData = array(),
    ) {
        parent::__construct();
        $this->controllerName = $controllerName;
        $this->selMenu = $selMenu;
        $this->PrefixRole = $PrefixRole;
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $this->PageTitle = __('admin/menu.web_product');

        $this->middleware('permission:' . $PrefixRole . '_view', ['only' => ['index']]);
        $this->middleware('permission:' . $PrefixRole . '_add', ['only' => ['create']]);
        $this->middleware('permission:' . $PrefixRole . '_edit', ['only' => ['edit']]);
        $this->middleware('permission:' . $PrefixRole . '_delete', ['only' => ['destroy']]);
        $this->middleware('permission:' . $PrefixRole . '_restore', ['only' => ['SoftDeletes', 'Restore', 'ForceDeletes']]);

        $viewDataTable = AdminHelper::arrIsset($this->modelSettings, $controllerName . '_datatable', 0);
        View::share('viewDataTable', $viewDataTable);
        View::share('tableHeader', AdminHelper::Table_Style($viewDataTable));
        View::share('PrefixRoute', $this->PrefixRoute);
        View::share('PrefixRole', $PrefixRole);
        View::share('controllerName', $controllerName);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'selMenu' => $this->selMenu,
            'prefix_Role' => $this->PrefixRole,
            'restore' => 1,
        ];
        $pageData = AdminHelper::returnPageDate($this->controllerName, $sendArr);
        $this->pageData = $pageData;

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        foreach (config('app.lang_file') as $key => $lang) {
            Cache::forget('ShopMenuCategory_Cash_' . $key);
            Cache::forget('WebsiteMenuCategory_Cash_' . $key);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = Product::onlyTrashed()->count();
        $Products = self::getSelectQuery(Product::def());
        return view('admin.shop.product_index', compact('pageData', 'Products'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $pageData['SubView'] = false;

        $Products = self::getSelectQuery(Product::onlyTrashed());
        return view('admin.shop.product_index', compact('pageData', 'Products'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SubCategory
    public function ListCategory($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = true;
        $Category = Category::findOrFail($id);
        $Products = Product::def()->whereHas('categories', function ($query) use ($id) {
            $query->where('category_id', $id);
        })->paginate(10);
        return view('admin.shop.product_index', compact('pageData', 'Products'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $Categories = Category::all();
        $Product = Product::findOrNew(0);
        $selCat = [];
        return view('admin.shop.product_form', compact('pageData', 'Product', 'Categories', 'selCat'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $Categories = Category::all();
        $Product = Product::where('id', $id)->with('categories')->firstOrFail();
        $selCat = $Product->categories()->pluck('category_id')->toArray();
        return view('admin.shop.product_form', compact('Product', 'pageData', 'Categories', 'selCat'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(ShopProductRequest $request, $id = 0) {

        $categories = $request->input('categories');
        $saveData = Product::findOrNew($id);


        $saveData->is_active = intval((bool)$request->input('is_active'));
        $saveData->is_archived = intval((bool)$request->input('is_archived'));

        $saveData->price = $request->input('price');
        $saveData->sale_price = $request->input('sale_price');
        $saveData->qty_left = $request->input('qty_left');
        $saveData->qty_max = $request->input('qty_max');
        $saveData->unit = $request->input('unit');
        $saveData->save();

        $saveData->categories()->sync($categories);

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('product/' . $saveData->id);
        $saveImgData->setnewFileName($request->input('en.slug'));
        $saveImgData->UploadOne($request);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData, $saveImgData);
        $saveData->save();

        foreach (config('app.shop_lang') as $key => $lang) {
            $saveTranslation = ProductTranslation::where('product_id', $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->product_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key . '.name');
            $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
            $saveTranslation->des = $request->input($key . '.des');
            $saveTranslation->save();
        }

        self::ClearCash();


        if($id == '0') {
            if($request->input('AddNewSet') !== null) {
                return redirect()->back();
            } else {
                return redirect(route($this->PrefixRoute . '.index'))->with('Add.Done', "");
            }
        } else {
            return redirect()->back();
            // return redirect(route($this->PrefixRoute.'.index'))->with('Edit.Done',"");
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id) {
        $deleteRow = Product::where('id', $id)->firstOrFail();
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     EmptyPhoto
    public function emptyPhoto($id) {
        $rowData = Product::findOrFail($id);
        $rowData = AdminHelper::DeleteAllPhotos($rowData, true);
        $rowData->save();
        self::ClearCash();
        return back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ListMorePhoto
    public function ListMorePhoto($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $Product = Product::findOrFail($id);
        $ProductPhotos = ProductPhoto::where('product_id', '=', $id)->orderBy('position')->get();
        return view('admin.shop.product_photos', compact('ProductPhotos', 'pageData', 'Product'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     AddMorePhotos
    public function AddMorePhotos(ProductPhotoRequest $request) {
        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('product/' . $request->product_id);
        $saveImgData->setnewFileName($request->input('name'));
        $saveImgData->UploadMultiple($request);

        foreach ($saveImgData->sendSaveData as $newPhoto) {
            $saveData = ProductPhoto::findOrNew('0');
            $saveData->product_id = $request->product_id;
            $saveData->photo = $newPhoto['photo']['file_name'];
            $saveData->photo_thum_1 = $newPhoto['photo_thum_1']['file_name'];
            $saveData->save();
        }
        self::ClearCash();
        return back()->with('Add.Done', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
    public function sortPhotoSave(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = ProductPhoto::findOrFail($id);
            $saveData->position = $newPosition;
            $saveData->save();
        }
        self::ClearCash();
        return response()->json(['success' => $positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosDestroy
    public function More_PhotosDestroy($id) {
        $deleteRow = ProductPhoto::findOrFail($id);
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Restore
    public function restored($id) {
        Product::onlyTrashed()->where('id', $id)->restore();
        self::ClearCash();
        return back()->with('restore', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeletes($id) {
        $deleteRow = Product::onlyTrashed()->where('id', $id)->with('more_photos')->firstOrFail();
        if(count($deleteRow->more_photos) > 0) {
            foreach ($deleteRow->more_photos as $del_photo) {
                AdminHelper::DeleteAllPhotos($del_photo);
            }
        }
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

}
