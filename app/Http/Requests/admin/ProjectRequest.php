<?php

namespace App\Http\Requests\admin;

use App\Helpers\AdminHelper;
use App\Models\admin\Listing;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    protected function prepareForValidation(){
        $this->merge([
            'slug'=> AdminHelper::Url_Slug($this->get('slug')),
        ]);
    }

    public function rules(Request $request): array{
        $request->merge(['slug' => AdminHelper::Url_Slug($request->slug)]);

        $id = $this->route('id');
        $addLang = json_decode($request->add_lang);

        if($id == '0'){
            $rules =['slug'=> "required|unique:listings"];
        }else{
            $rules =['slug'=> "required|regex:/^(\d+)+-+[^\/]+$/u|unique:listings,slug,$id"];
            foreach( $addLang as $key=>$lang){
                $rules[$key.".g_des"] =   'required';
                $rules[$key.".g_title"] =   'required';
            }
        }

        $rules += [
            'location_id'=> "required",
            'developer_id'=> "required",
            'project_type'=> "required",
            'status'=> "required",
            'delivery_date'=> "nullable|integer|min:2000|max:2050",
            'price'=> "nullable|integer",
            'latitude'=> "nullable|numeric|required_with:longitude",
            'longitude'=> "nullable|numeric|required_with:latitude",
            'youtube_url'=> "nullable|alpha_dash:ascii",
            'amenity' => "required|array|min:3",
        ];

        foreach( $addLang as $key=>$lang){
            $rules[$key.".name"] =   'required';
            $rules[$key.".des"] =   'required';
        }

        return $rules;
    }


    public function messages(){
        return [
            'slug.regex' => __('admin/alertMass.confirmSlugRegex') ,
        ];
    }

}
