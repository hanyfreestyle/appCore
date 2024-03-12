<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\ProductAttribute;
use App\AppPlugin\Product\Models\ProductAttributeValue;
use App\AppPlugin\Product\Models\ProductAttributeValueTranslation;
use App\AppPlugin\Product\Request\ProductAttributeValueRequest;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class ShopAttributeValueController extends AdminMainController {
    use CrudTraits;

    function __construct(Request $request,ProductAttributeValue $model) {
        parent::__construct();
        $this->controllerName = "ProAttributeValue";
        $this->PrefixRole = 'Product';
        $this->selMenu = "Shop.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_attribute');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0,"orderbyPostion"=>1],
            'yajraTable' => false,
            'AddLang' => false,
            'restore' => 0,
            'WithSubCat'=> true,
            'ModelId'=> $request->route()->parameter('AttributeId'),
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
    public function index($AttributeId) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $Attribute = ProductAttribute::with('translation')->where('id',$AttributeId)->firstOrFail();
        $rowData = self::getSelectQuery(ProductAttributeValue::def()->where('attribute_id',$AttributeId));
        return view('AppPlugin.Product.attribute_value_index', compact('pageData', 'rowData','Attribute'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create($AttributeId) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $Attribute = ProductAttribute::with('translation')->where('id',$AttributeId)->firstOrFail();
        $rowData = ProductAttributeValue::findOrNew(0);
        return view('AppPlugin.Product.attribute_value_form',compact('rowData','pageData','Attribute'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = ProductAttributeValue::where('id', $id)->firstOrFail();
        $Attribute = ProductAttribute::with('translation')->where('id',$rowData->attribute_id)->firstOrFail();
        return view('AppPlugin.Product.attribute_value_form',compact('rowData','pageData','Attribute'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(ProductAttributeValueRequest $request, $id = 0) {
        $saveData = ProductAttributeValue::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->is_active = intval((bool)$request->input('is_active'));
                $saveData->attribute_id = $request->input('attribute_id');
                $saveData->save();
                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = ProductAttributeValueTranslation::where('value_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->locale = $key;
                    $saveTranslation->value_id = $saveData->id;
                    $saveTranslation->name = $request->input($key . '.name');
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation->save();
                }
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return  self::redirectWhereNew($request,$id, route($this->PrefixRoute.'.index',$request->input('attribute_id')));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategorySort
    public function Sort($AttributeId) {
        $Attribute = ProductAttribute::with('translation')->where('id',$AttributeId)->firstOrFail();
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $rowData = ProductAttributeValue::where('attribute_id',$Attribute->id)->orderBy('postion')->get();
        return view('AppPlugin.Product.attribute_value_sort', compact('pageData', 'rowData', 'Attribute'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SaveSort
    public function SaveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = ProductAttributeValue::findOrFail($id);
            $saveData->postion = $newPosition;
            $saveData->save();
        }
        self::ClearCash();
        return response()->json(['success' => $positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeleteException($id) {
        dd('hi');
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


}
