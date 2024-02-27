<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\CategoryTranslation;
use App\AppPlugin\Product\Request\CategoryRequest;
use App\Helpers\AdminHelper;

use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;

use App\Http\Traits\CrudTraits;

use App\Models\admin\Listing;
use App\Models\admin\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;


class ShopCategoryController extends AdminMainController {

    use CrudTraits;

    function __construct(Category $model) {
        parent::__construct();
        $this->controllerName = "Category";
        $this->PrefixRole = 'Product';
        $this->selMenu = "Shop.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_category');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;
        $this->UploadDirIs = 'project';

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["editor" => 1],
            'yajraTable' => false,
            'AddLang' => true,
        ];

        self::loadConstructData($sendArr);

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('ssssssss');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index($id = null) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = Category::onlyTrashed()->count();
        $trees = [];

        if(Route::currentRouteName() == 'Shop.Category.index_Main') {
            $rowData = self::getSelectQuery(Category::def()->where('parent_id', null));
        } elseif(Route::currentRouteName() == 'Shop.Category.SubCategory') {
            $rowData = self::getSelectQuery(Category::def()->where('parent_id', $id));
            $trees = Category::find($id)->ancestorsAndSelf()->orderBy('depth', 'asc')->get();
            $pageData['SubView'] = true;
        } else {
            $rowData = self::getSelectQuery(Category::def());
        }
        return view('AppPlugin.Product.category_index', compact('pageData', 'rowData','trees'));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $LangAdd = self::getAddLangForAdd();
        $Categories = Category::tree()->with('translation')->get()->toTree();
        $rowData = Category::findOrNew(0);
        return view('AppPlugin.Product.category_form', compact('pageData', 'rowData', 'LangAdd', 'Categories'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $Categories = Category::tree()->with('translation')->get()->toTree();
        $rowData = Category::with('translations')->findOrFail($id);
        $LangAdd = self::getAddLangForEdit($rowData);
        return view('AppPlugin.Product.category_form', compact('pageData', 'rowData', 'LangAdd', 'Categories'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(CategoryRequest $request, $id = 0) {

        $saveData = Category::findOrNew($id);
        if($request->input('parent_id') != 0 and $request->input('parent_id') != $saveData->id) {
            $saveData->parent_id = $request->input('parent_id');
        }

        $saveData->is_active = intval((bool)$request->input('is_active'));
        $saveData->save();

        self::SaveAndUpdateDefPhoto($saveData,$request,'category','en.slug');

        $saveImgData_icon = new PuzzleUploadProcess();
        $saveImgData_icon->setUploadDirIs('category/' . $saveData->id);
        $saveImgData_icon->setnewFileName($request->input('en.slug'));
        $saveImgData_icon->setfileUploadName('icon');
        $saveImgData_icon->UploadOneNofilter($request, '4', 60, 60);
        $saveData = AdminHelper::saveAndDeletePhotoByOne($saveData, $saveImgData_icon, 'icon');
        $saveData->save();

        $addLang = json_decode($request->add_lang);
        foreach ($addLang as $key => $lang) {
            $saveTranslation = CategoryTranslation::where('category_id', $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->category_id = $saveData->id;
            $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
            $saveTranslation = self::saveTranslationMain($saveTranslation,$key,$request);
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
        return  self::redirectWhere($request,$id,$this->PrefixRoute.'.index');

    }

    /*




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
    */


}
