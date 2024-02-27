<?php

namespace App\AppPlugin\Product\Request;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        $data = $this->toArray();
        foreach (config('app.web_lang') as $key => $lang) {
            data_set($data, $key . '.slug', AdminHelper::Url_Slug($data[$key]['slug']));
        }
        $this->merge($data);
    }

    public function rules(Request $request): array {
        foreach (config('app.web_lang') as $key => $lang) {
            $request->merge([$key . '.slug' => AdminHelper::Url_Slug($request[$key]['slug'])]);
        }

        $id = $this->route('id');

        $rules = [
            'categories' => 'required|array|min:1',
            #'unit'=> "required",
            'price' => "required|numeric",
            'sale_price' => "nullable|numeric|lt:price",
            'qty_left' => "nullable|integer",
            'qty_max' => "required|integer",
        ];

        foreach (config('app.web_lang') as $key => $lang) {
            $rules[$key . ".name"] = 'required';
            if($id == '0') {
                $rules[$key . ".slug"] = 'required|unique:pro_product_translations,slug';
            } else {
                $rules[$key . ".slug"] = "required|unique:pro_product_translations,slug,$id,product_id,locale,$key";
            }
        }

        return $rules;
    }
}
