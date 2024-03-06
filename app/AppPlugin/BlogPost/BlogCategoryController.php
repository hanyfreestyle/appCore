<?php

namespace App\AppPlugin\BlogPost;


use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\BlogPost\Models\BlogCategoryTranslation;


use App\AppPlugin\Faq\Request\FaqCategoryRequest;
use App\Helpers\AdminHelper;

use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\CategoryTraits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class BlogCategoryController extends AdminMainController {

    use CrudTraits;
    use CategoryTraits;

    function __construct(BlogCategory $model, BlogCategoryTranslation $translation) {
        parent::__construct();
        $this->controllerName = "BlogCategory";
        $this->PrefixRole = 'Blog';
        $this->selMenu = "Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/blogPost.app_menu_category');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $this->UploadDirIs = 'BlogCat';
        $this->translation = $translation;
        $this->translationdb = 'category_id';


        self::SetCatTree(true, 2);

        $this->categoryIcon = true;
        View::share('categoryIcon', $this->categoryIcon);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["editor" => 1, 'iconfilterid' => 1, 'labelView' => 1],
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
    public function CategoryStoreUpdate(FaqCategoryRequest $request, $id = 0) {

        return self::TraitsCategoryStoreUpdate($request, $id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyException($id) {
        $deleteRow = FaqCategory::where('id', $id)
            ->withCount('del_category')
            ->withCount('del_faq')
            ->firstOrFail();



        if($deleteRow->del_category_count == 0 and $deleteRow->del_faq_count == 0) {
            try {
                DB::transaction(function () use ($deleteRow, $id) {
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    AdminHelper::DeleteDir($this->UploadDirIs, $id);
                    $deleteRow->forceDelete();
                });
            } catch (\Exception $exception) {
                return back()->with(['confirmException' => '', 'fromModel' => 'CategoryFaq', 'deleteRow' => $deleteRow]);
            }
        } else {
            return back()->with(['confirmException' => '', 'fromModel' => 'CategoryFaq', 'deleteRow' => $deleteRow]);
        }

        self::ClearCash();
        return back()->with('confirmDelete', "");
    }


}
