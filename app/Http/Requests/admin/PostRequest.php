<?php

namespace App\Http\Requests\admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PostRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug'=> AdminHelper::Url_Slug($this->get('slug')),
        ]);
    }


    public function rules(Request $request): array
    {
        $request->merge(['slug' => AdminHelper::Url_Slug($request->slug)]);

        $id = $this->route('id');
        $addLang = json_decode($request->add_lang);


        if($id == '0'){
            $rules =['slug'=> "required|unique:posts",];
        }else{
            $rules =['slug'=> "required|unique:posts,slug,$id",];
            foreach( $addLang as $key=>$lang){
                $rules[$key.".g_des"] =   'required';
                $rules[$key.".g_title"] =   'required';
            }
        }

        foreach( $addLang as $key=>$lang){
            $rules[$key.".name"] =   'required';
            $rules[$key.".des"] =   'required';
//            $rules[$key.".g_des"] =   'required';
        }

        $rules += [
            'category_id'=> "required",
        ];


        return $rules;
    }
}
