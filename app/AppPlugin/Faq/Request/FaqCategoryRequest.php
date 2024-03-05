<?php

namespace App\AppPlugin\Faq\Request;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FaqCategoryRequest extends FormRequest {

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
            'parent_id' => "nullable",
        ];

        $rules += AdminMainController::FormRequestSeo($id, $addLang, 'faq_category_translations');
        return $rules;
    }
}
