<?php

namespace App\AppPlugin\Product\Request;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductAttributeRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {

    }

    public function rules(Request $request): array {
        $id = $this->route('id');
        $rules = [];
        foreach (config('app.web_lang') as $key => $lang) {
            if($id == '0') {
                $rules[$key . ".name"] = "required|unique:pro_attribute_translations,name";
            } else {
                $rules[$key . ".name"] = "required|unique:pro_attribute_translations,name,$id,attribute_id,locale,$key";
            }
        }
        return $rules;
    }
}
