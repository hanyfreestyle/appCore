<?php

namespace App\AppPlugin\Product;

use App\Helpers\AdminHelper;

use App\Http\Controllers\AdminMainController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ShopCategoryController extends AdminMainController {

    public $controllerName;
    public $PageTitle;
    public $selMenu;
    public $PrefixRole;
    public $PrefixRoute;
    public $pageData;

    function __construct(
        $selMenu = 'Shop.',
        $controllerName = 'shopCategory',
        $PrefixRole = 'shopCategory',
        $PrefixRoute = '#',
        $pageData = array(),
    ) {
        parent::__construct();
        $this->controllerName = $controllerName;
        $this->selMenu = $selMenu;
        $this->PrefixRole = $PrefixRole;
        $this->PrefixRoute = $this->selMenu . $this->controllerName;


        $this->PageTitle = __('admin/menu.web_category');

        $this->middleware('permission:' . $PrefixRole . '_view', ['only' => ['index']]);
        $this->middleware('permission:' . $PrefixRole . '_add', ['only' => ['create']]);
        $this->middleware('permission:' . $PrefixRole . '_edit', ['only' => ['edit']]);
        $this->middleware('permission:' . $PrefixRole . '_delete', ['only' => ['destroy']]);


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
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index($id = null) {

        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = Category::onlyTrashed()->count();
        $pageData['ConfigUrl'] = route('Shop.shopCategoryConfig.Config');
        $trees = [];
        if(Route::currentRouteName() == 'Shop.shopCategory.index_Main') {
            $Categories = self::getSelectQuery(Category::def()->where('parent_id', null));
        } elseif(Route::currentRouteName() == 'Shop.shopCategory.SubCategory') {
            $Categories = self::getSelectQuery(Category::def()->where('parent_id', $id));
            $trees = Category::find($id)->ancestorsAndSelf()->orderBy('depth', 'asc')->get();
            $pageData['SubView'] = true;
        } else {
            $Categories = self::getSelectQuery(Category::def());
        }
        return view('admin.shop.category_index', compact('pageData', 'Categories', 'trees'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $pageData['SubView'] = false;

        $Categories = self::getSelectQuery(Category::onlyTrashed());
        $trees = [];

        return view('admin.shop.category_index', compact('pageData', 'Categories', 'trees'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $Categories = Category::tree()->with('translation')->get()->toTree();
        $Category = Category::findOrNew(0);
        return view('admin.shop.category_form', compact('pageData', 'Category', 'Categories'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $Categories = Category::tree()->get()->toTree();
        $Category = Category::findOrFail($id);
        return view('admin.shop.category_form', compact('Category', 'pageData', 'Categories'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(ShopCategoryRequest $request, $id = 0) {

        $saveData = Category::findOrNew($id);
        if($request->input('parent_id') != 0 and $request->input('parent_id') != $saveData->id) {
            $saveData->parent_id = $request->input('parent_id');
        }

        $saveData->is_active = intval((bool)$request->input('is_active'));
        $saveData->save();

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('category/' . $saveData->id);
        $saveImgData->setnewFileName($request->input('en.slug'));
        $saveImgData->UploadOne($request);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData, $saveImgData);
        $saveData->save();

        $saveImgData_icon = new PuzzleUploadProcess();
        $saveImgData_icon->setUploadDirIs('category/' . $saveData->id);
        $saveImgData_icon->setnewFileName($request->input('en.slug'));
        $saveImgData_icon->setfileUploadName('icon');
        $saveImgData_icon->UploadOneNofilter($request, '4', 60, 60);
        $saveData = AdminHelper::saveAndDeletePhotoByOne($saveData, $saveImgData_icon, 'icon');
        $saveData->save();

        foreach (config('app.shop_lang') as $key => $lang) {
            $saveTranslation = CategoryTranslation::where('category_id', $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->category_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key . '.name');
            $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
            $saveTranslation->des = $request->input($key . '.des');
            $saveTranslation->save();
        }

        if($saveData->is_active == false) {
            $trees = Category::find($id)->descendants()->pluck('id')->toArray();
            if(count($trees) > 0) {
                Category::whereIn("id", $trees)
                    ->update([
                        'is_active' => 0,
                    ]);
            }
        }

        self::ClearCash();

        if($id == '0') {

            if($request->input('AddNewSet') !== null) {
                return redirect()->back();
            } else {
                return redirect(route($this->PrefixRoute . '.index'))->with('Add.Done', "");
            }

        } else {
            return redirect(route($this->PrefixRoute . '.index'))->with('Edit.Done', "");
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id) {
        $deleteRow = Category::findOrFail($id);
        # $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     EmptyPhoto
    public function emptyPhoto($id) {
        $rowData = Category::findOrFail($id);
        $rowData = AdminHelper::DeleteAllPhotos($rowData, true);
        $rowData->save();
        self::ClearCash();
        return back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     EmptyPhoto
    public function emptyIcon($id) {
        $rowData = Category::findOrFail($id);
        $rowData = AdminHelper::DeleteAllPhotos($rowData, true, ['icon']);
        $rowData->save();
        self::ClearCash();
        return back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     config
    public function config() {
        $pageData = $this->pageData;
        $pageData['TitlePage'] = "اعدادات القسم";
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;

        return view('admin.shop.config', compact('pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategorySort
    public function CategorySort($id) {
        $sendArr = ['TitlePage' => $this->PageTitle, 'selMenu' => $this->selMenu];
        $pageData = AdminHelper::returnPageDate($this->controllerName, $sendArr);
        $pageData['ViewType'] = "List";
        $Category = [];
        if($id == 0) {
            $Categories = self::getSelectQuery(Category::def()->where('parent_id', null)->orderBy('postion'));
        } else {
            $Category = Category::findOrNew($id);
            $Categories = self::getSelectQuery(Category::def()->where('parent_id', $Category->id)->orderBy('postion'));
        }
        return view('admin.shop.category_sort', compact('pageData', 'Categories', 'Category'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategorySaveSort
    public function CategorySaveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = Category::findOrFail($id);
            $saveData->postion = $newPosition;
            $saveData->save();
        }
        self::ClearCash();
        return response()->json(['success' => $positions]);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Restore
    public function restored($id) {
        Category::onlyTrashed()->where('id', $id)->restore();
        self::ClearCash();
        return back()->with('restore', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeletes($id) {
        $deleteRow = Category::onlyTrashed()->where('id', $id)->firstOrFail();
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

}
