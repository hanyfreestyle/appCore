<?php

namespace App\AppPlugin\Product\Request;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        $data = $this->toArray();
        $data = AdminMainController::prepareSlug($data);
        $this->merge($data);
    }

    public function rules(Request $request): array {

        $addLang = json_decode($request->add_lang);
        foreach ($addLang as $key => $lang) {
            $request->merge([$key . '.slug' => AdminHelper::Url_Slug($request[$key]['slug'])]);
        }

        $id = $this->route('id');

        $rules = [
            'categories' => 'required|array|min:1',
            'price' => "required|numeric",
            'sale_price' => "nullable|numeric|lt:price",
            'qty_left' => "nullable|integer",
            'qty_max' => "required|integer",
        ];

        $rules += AdminMainController::FormRequestSeo($id,$addLang,'pro_product_translations','product_id');

        return $rules;
    }
}
