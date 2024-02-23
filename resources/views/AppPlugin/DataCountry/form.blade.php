@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">


            <form  class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12">
                    <div class="row">
                        <x-admin.form.input name="iso2" value="{{old('iso2',$rowData->iso2)}}" label="ISO2" colrow="col-lg-2" inputclass="dir_en"/>
                        <x-admin.form.input name="iso3" value="{{old('iso3',$rowData->iso3)}}" label="ISO3" colrow="col-lg-2" inputclass="dir_en"/>
                        <x-admin.form.input name="fips" value="{{old('fips',$rowData->fips)}}" label="FIPS" colrow="col-lg-2" inputclass="dir_en"/>
                        <x-admin.form.input name="iso_numeric" value="{{old('iso_numeric',$rowData->iso_numeric)}}" label="ISO Numeric" colrow="col-lg-2" inputclass="dir_en"/>
                        <x-admin.form.input name="phone" value="{{old('phone',$rowData->phone)}}" label="Phone Code" colrow="col-lg-2" inputclass="dir_en"/>
                        <x-admin.form.input name="symbol" value="{{old('symbol',$rowData->symbol)}}" label="Symbol" colrow="col-lg-2" inputclass="dir_en"/>
                    </div>

                    <div class="row">
                        <x-admin.form.input name="currency_code" value="{{old('currency_code',$rowData->currency_code)}}" label="Currency Code" colrow="col-lg-2" inputclass="dir_en"/>
                        <x-admin.form.input name="continent_code" value="{{old('continent_code',$rowData->continent_code)}}" label="Continent Code" colrow="col-lg-2" inputclass="dir_en"/>
                        <x-admin.form.input name="language_codes" value="{{old('language_codes',$rowData->language_codes)}}" label="Language Code" colrow="col-lg-2" inputclass="dir_en"/>
                        <x-admin.form.input name="top_level_domain" value="{{old('top_level_domain',$rowData->top_level_domain)}}" label="Top Level Domain" colrow="col-lg-2" inputclass="dir_en"/>
                        <x-admin.form.input name="time_zone" value="{{old('time_zone',$rowData->time_zone)}}" label="Time Zone" colrow="col-lg-2" inputclass="dir_en"/>
                        <x-admin.form.input name="area_km" value="{{old('area_km',$rowData->area_km)}}" label="Area KM2" colrow="col-lg-2" inputclass="dir_en"/>
                    </div>

                </div>



                <div class="col-lg-12">
                    <div class="row">
                        @foreach ( config('app.admin_lang') as $key=>$lang )
                            <div class="col-lg-6 {{getColDir($key)}}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <x-admin.form.trans-input label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                                                                  name="{{ $key }}[name]" dir="{{ $key }}" reqname="{{ $key }}.name"
                                                                  value="{{old($key.'.name',$rowData->translateOrNew($key)->name)}}"/>
                                    </div>
                                    <div class="col-lg-6">
                                        <x-admin.form.trans-input label="{{__('admin/data/country.t_capital')}} ({{ $key}})"
                                                                  name="{{ $key }}[capital]" dir="{{ $key }}" reqname="{{ $key }}.capital"
                                                                  value="{{old($key.'.capital',$rowData->translateOrNew($key)->capital)}}"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <x-admin.form.trans-input
                                            label="{{__('admin/data/country.t_currency')}} ({{ $key}})"
                                            name="{{ $key }}[currency]"
                                            dir="{{ $key }}"
                                            reqname="{{ $key }}.currency"
                                            value="{{old($key.'.currency',$rowData->translateOrNew($key)->currency)}}"
                                        />
                                    </div>
                                    <div class="col-lg-4">
                                        <x-admin.form.trans-input
                                            label="{{__('admin/data/country.t_nationality')}} ({{ $key}})"
                                            name="{{ $key }}[nationality]"
                                            dir="{{ $key }}"
                                            reqname="{{ $key }}.nationality"
                                            value="{{old($key.'.nationality',$rowData->translateOrNew($key)->nationality)}}"
                                        />
                                    </div>
                                    <div class="col-lg-4">
                                        <x-admin.form.trans-input
                                            label="{{__('admin/data/country.t_continent')}} ({{ $key}})"
                                            name="{{ $key }}[continent]"
                                            dir="{{ $key }}"
                                            reqname="{{ $key }}.continent"
                                            value="{{old($key.'.continent',$rowData->translateOrNew($key)->continent)}}"
                                        />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>


@endsection






