<?php

namespace App\Http\Requests\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\admin\PageAdminController;
use App\Models\admin\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function __construct(Request $request)
    {
        $val = PageAdminController::createHash($request);

        $request->request->add(['hash_send' => $val]);

    }

    protected function prepareForValidation(){

    }


    public function rules(Request $request): array
    {

       // dd($request->all());

        $id = $this->route('id');
        $rules = [
             'location_id' => "required_if:compound_id,null",
             'compound_id' => "required_if:location_id,null",
        ];

        if($id == '0'){
            $rules += ['hash_send' => "required|unique:pages,hash"];
        }else{
            $rules += ['hash_send' => "required|unique:pages,hash,$id"];
        }


        foreach(config('app.web_lang') as $key=>$lang){
            if($id == '0'){
                $rules[$key.".name"] = 'required|unique:page_translations,name';
            }else{
                $rules[$key.".name"] = "required|unique:page_translations,name,$id,page_id,locale,$key";
                $rules[$key.".g_title"] =   'required';
                $rules[$key.".g_des"] =   'required';
            }
            $rules[$key.".des"] =   'required';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'location_id.required_if' => __('admin/page.mod_required_if'),
            'compound_id.required_if' => __('admin/page.mod_required_if'),
            'hash_send.unique' => __('admin/page.mod_hash_send_error'),
        ];
    }

}
