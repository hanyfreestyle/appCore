<?php

namespace App\Http\Requests\admin\config;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class SettingFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array{

        $rules =[
            'web_status'=> 'required',
            'fav_view'=> 'required',
            'phone_num'=> 'required',
            'whatsapp_num'=> 'required',
            'phone_call'=> 'required|numeric',
            'whatsapp_send'=> 'required|numeric',
            'email'=> 'required|email',
            'facebook'=> 'nullable|url',
            'twitter'=> 'nullable|url',
            'youtube'=> 'nullable|url',
            'instagram'=> 'nullable|url',
            'google_api'=> 'nullable',
        ];


        foreach(config('app.web_lang') as $key=>$lang){
            $rules[$key.".name"] =   'required';
            $rules[$key.".closed_mass"] =   'required';
        }
        return $rules;
    }
}
