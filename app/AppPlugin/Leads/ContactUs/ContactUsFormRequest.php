<?php

namespace App\AppPlugin\Leads\ContactUs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactUsFormRequest extends FormRequest{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array{
        $request_type = $request->input('request_type');
        $countryCode = strtoupper($request->input('countryCode_phone'));
        $rules =  [
            'name'=> "required|min:4|max:50",
            'phone'=> "required|numeric|phone:mobile,$countryCode",
            // 'phone'=> "required|numeric|min_digits:9",
        ];

        if($request_type == 1){
            $rules +=  [
                'subject'=> "required|min:4|max:50",
                'message'=> "required|max:250",
            ];
        }
        if($request_type == 3){
            $rules += [
                'meeting_time' => "required",
                'meeting_day' => "required",
            ];
        }

        return $rules;
    }

    public function messages(){
        return [
//            'slug.regex' => __('admin/alertMass.confirmSlugRegex') ,
        ];
    }

}
