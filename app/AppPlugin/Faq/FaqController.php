<?php

namespace App\AppPlugin\Faq;

use App\AppPlugin\Faq\Models\Faq;
use App\AppPlugin\Faq\Models\FaqCategory;
use App\AppPlugin\Faq\Models\FaqPhoto;
use App\AppPlugin\Faq\Models\FaqPhotoTranslation;
use App\AppPlugin\Faq\Models\FaqTranslation;

use App\AppPlugin\Faq\Request\FaqRequest;
use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;

use App\Http\Controllers\AdminMainController;

use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class FaqController extends AdminMainController {

    use CrudTraits;


    function __construct(Faq $model, FaqTranslation $translation, FaqPhoto $modelPhoto) {
        parent::__construct();
        $this->controllerName = "Question";
        $this->PrefixRole = 'Faq';
        $this->selMenu = "Faq.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/faq.app_menu_faq');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;
        $this->modelPhoto = $modelPhoto;
        $this->modelPhotoColumn = 'faq_id';
        $this->modelPhotoEdit = true;
        View::share('modelPhotoEdit', $this->modelPhotoEdit);

        $this->UploadDirIs = 'faq';
        $this->translation = $translation;
        $this->translationdb = 'faq_id';

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
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosEdit    
    public function More_PhotosEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = FaqPhoto::where('id', $id)
            ->with('faqName')
            ->firstOrFail();
        return view('admin.mainView.MorePhoto_edit', compact('rowData', 'pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosEdit
    public function More_PhotosEditAll($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $thisModel = Faq::findOrFail($id) ;
        $rowData = FaqPhoto::where('faq_id','=',$id)->with('translations')->orderBy('position')->get();

        $FaqPhotosData = $rowData->toArray();

        return view('admin.mainView.MorePhoto_editAll', compact('rowData', 'pageData','thisModel'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   More_PhotosUpdateAll
    public function More_PhotosUpdateAll(Request $request, $id){
        foreach ($request->input('id') as $id){
            $UpdatePhoto = FaqPhoto::findOrFail($id) ;
            $UpdatePhoto->print_photo = $request->input('print_photo_'.$id) ?? 2;
            $UpdatePhoto->save();

            foreach (config('app.web_lang') as $key => $lang) {
                $dbName = 'photo_id';
                $saveTranslation = FaqPhotoTranslation::where($dbName, $UpdatePhoto->id)->where('locale', $key)->firstOrNew();
                $saveTranslation->$dbName = $UpdatePhoto->id;
                $saveTranslation->locale = $key;
                $saveTranslation->des = $request->input('des_'.$key.'_'.$id);
                $saveTranslation->save();
            }
        }

        self::ClearCash();
        return redirect()->back()->with('Edit.Done', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function More_PhotosUpdate(Request $request, $id) {

        $saveData = FaqPhoto::findOrNew($id);

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('faq/' . $saveData->faq_id);
        $saveImgData->setnewFileName($saveData->name);
        $saveImgData->UploadOne($request);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData, $saveImgData);
        $saveData->save();

        foreach (config('app.web_lang') as $key => $lang) {
            $dbName = 'photo_id';
            $saveTranslation = FaqPhotoTranslation::where($dbName, $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->$dbName = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->des = $request->input($key . '.des');
            $saveTranslation->save();
        }

        self::ClearCash();
        return redirect()->back()->with('Edit.Done', "");
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
        $pageData['Trashed'] = Faq::onlyTrashed()->count();
        $rowData = self::getSelectQuery(Faq::def());
        return view('AppPlugin.Faq.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $pageData['SubView'] = false;
        $rowData = self::getSelectQuery(Faq::onlyTrashed());
        return view('AppPlugin.Faq.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SubCategory
    public function ListCategory($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = true;
        $Category = FaqCategory::findOrFail($id);
        $rowData = Faq::def()->whereHas('categories', function ($query) use ($id) {
            $query->where('category_id', $id);
        })->paginate(10);
        return view('AppPlugin.Faq.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $Categories = FaqCategory::all();
        $rowData = Faq::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();
        $selCat = [];
        return view('AppPlugin.Faq.form')->with([
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
        $Categories = FaqCategory::all();
        $rowData = Faq::where('id', $id)->with('categories')->firstOrFail();
        $selCat = $rowData->categories()->pluck('category_id')->toArray();
        $LangAdd = self::getAddLangForEdit($rowData);
        return view('AppPlugin.Faq.form')->with([
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
    public function storeUpdate(FaqRequest $request, $id = 0) {
        $saveData = Faq::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $categories = $request->input('categories');
                $saveData->is_active = intval((bool)$request->input('is_active'));
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


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeleteException($id) {
        $deleteRow = Faq::onlyTrashed()->where('id', $id)->with('more_photos')->firstOrFail();
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

}
