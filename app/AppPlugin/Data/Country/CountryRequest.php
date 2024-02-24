<?php

namespace App\AppPlugin\Data\Country;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CountryRequest extends FormRequest {

  public function authorize(): bool {
    return true;
  }

  public function rules(Request $request): array {


    $id = $this->route('id');

    if($id == '0') {
      $rules = ['iso2' => "required|min:2|max:2|unique:data_countries"];
      $rules += ['iso3' => "required|min:3|max:3|alpha|unique:data_countries"];
      $rules += ['fips' => "required|min:2|max:2|alpha|unique:data_countries"];
      $rules += ['iso_numeric' => "required|numeric|unique:data_countries"];
      $rules += ['phone' => "required|numeric|unique:data_countries"];
    } else {
      $rules = ['iso2' => "required|min:2|max:2|alpha|unique:data_countries,iso2,$id"];
      $rules += ['iso3' => "required|min:3|max:3|alpha|unique:data_countries,iso3,$id"];
      $rules += ['fips' => "required|min:2|max:2|alpha|unique:data_countries,fips,$id"];
      $rules += ['iso_numeric' => "required|numeric|unique:data_countries,iso_numeric,$id"];
      $rules += ['phone' => "required|numeric|unique:data_countries,phone,$id"];
    }

    $rules += [
      'symbol' => "required",
      'currency_code' => "required|alpha",
      'continent_code' => "required|min:2|max:2|alpha",
      'language_codes' => "required",
      'time_zone' => "required",
    ];


    foreach (config('app.admin_lang') as $key => $lang) {
      $rules[$key . ".name"] = 'required';
      $rules[$key . ".capital"] = 'required';
      $rules[$key . ".currency"] = 'required';
      $rules[$key . ".continent"] = 'required';
      $rules[$key . ".nationality"] = 'required';
    }


    return $rules;
  }


}
