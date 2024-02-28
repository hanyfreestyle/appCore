<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\CategoryTranslation;
use App\AppPlugin\Product\Request\CategoryRequest;
use App\Helpers\AdminHelper;

use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\CategoryTraits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class ShopCategoryController extends AdminMainController {

    use CrudTraits;
    use CategoryTraits ;

    function __construct(Category $model,CategoryTranslation $translation) {
        parent::__construct();
        $this->controllerName = "Category";
        $this->PrefixRole = 'Product';
        $this->selMenu = "Shop.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_category');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $this->UploadDirIs = 'category';
        $this->translation = $translation;
        $this->translationdb = 'category_id';

        $this->categoryTree = false;
        View::share('categoryTree',$this->categoryTree);

        if( $this->categoryTree ){
            $this->Categories = Category::tree()->with('translation')->get()->toTree();
        }else{
            $this->Categories = [];
        }
        View::share('Categories',$this->Categories);

        $this->categoryIcon = true;
        View::share('categoryIcon',$this->categoryIcon);


        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["editor" => 1,'iconfilterid'=>1 ],
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
#|||||||||||||||||||||||||||||||||||||| #     CategoryStoreUpdate
    public function CategoryStoreUpdate(CategoryRequest $request, $id = 0) {
       return  self::TraitsCategoryStoreUpdate($request,$id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyException($id){
        $deleteRow =  Category::where('id',$id)
            ->withCount('del_category')
            ->withCount('del_product')
            ->firstOrFail();

        if($deleteRow->del_category_count == 0 and $deleteRow->del_product_count == 0 ){
            try{
                DB::transaction(function () use  ($deleteRow,$id){
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    AdminHelper::DeleteDir($this->UploadDirIs,$id);
                    $deleteRow->forceDelete();
                });
            }catch (\Exception $exception){
                return back()->with(['confirmException'=>'','fromModel'=>'CategoryProduct','deleteRow'=>$deleteRow]);
            }
        }else{
            return back()->with(['confirmException'=>'','fromModel'=>'CategoryProduct','deleteRow'=>$deleteRow]);
        }

        self::ClearCash();
        return back()->with('confirmDelete',"");
    }



}
