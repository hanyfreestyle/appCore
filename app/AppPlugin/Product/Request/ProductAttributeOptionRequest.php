<?php

namespace App\AppPlugin\Product\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductAttributeOptionRequest extends FormRequest {

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
                $rules[$key . ".name"] = "required|unique:pro_attribute_option_translations,name";
            } else {
                $rules[$key . ".name"] = "required|unique:pro_attribute_option_translations,name,$id,option_id,locale,$key";
            }
        }
        return $rules;
    }
}
