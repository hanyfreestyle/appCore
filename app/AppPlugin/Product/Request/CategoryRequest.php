<?php

namespace App\AppPlugin\Product\Request;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {

        $data = $this->toArray();
        $addLang = json_decode($data['add_lang']);

        foreach ($addLang as $key => $lang) {
            data_set($data, $key . '.slug', AdminHelper::Url_Slug($data[$key]['slug']));
        }
        $this->merge($data);
    }

    public function rules(Request $request): array {

        $addLang = json_decode($request->add_lang);

        foreach ($addLang as $key => $lang) {
            $request->merge([$key . '.slug' => AdminHelper::Url_Slug($request[$key]['slug'])]);
        }

        $id = $this->route('id');

        $rules = [
//            'parent_id' => "required",
        ];

        foreach ($addLang as $key => $lang) {
            $rules[$key . ".name"] = 'required';
//            $rules[$key . ".des"] = 'required';
            if($id == '0') {
                $rules[$key . ".slug"] = 'required|unique:pro_category_translations,slug';
            } else {
                $rules[$key . ".slug"] = "required|unique:pro_category_translations,slug,$id,category_id,locale,$key";
//                $rules[$key.".g_des"] =   'required';
//                $rules[$key.".g_title"] =   'required';
            }
        }

        return $rules;
    }
}
