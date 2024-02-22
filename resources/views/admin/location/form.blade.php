@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form  class="mainForm" action="{{route('location.update',intval($location->id))}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-admin.form.input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-12 {{getColDir('en')}}"
                                        value="{{old('slug',$location->slug)}}"  dir="en" inputclass="dir_en"/>
                </div>

                <div class="row">
                    <x-admin.form.select-arr  name="parent_id" label="{{__('admin/project.loction')}}" :sendvalue="old('parent_id',$location->parent_id)" :required-span="false" colrow="col-lg-3 " :send-arr="$locationList"/>
                    <x-admin.form.select-arr  name="projects_type" label="{{__('admin/project.type')}}" :sendvalue="old('projects_type',$location->projects_type)" :required-span="false" colrow="col-lg-3 " :send-arr="$ProjectType_Arr"/>

                    <x-admin.form.input label="Latitude" name="latitude" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                                        value="{{old('latitude',$location->latitude)}}"  dir="en" :required-span="false" inputclass="dir_en"/>

                    <x-admin.form.input label=" Longitude" name="longitude" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                                        value="{{old('longitude',$location->longitude)}}"  dir="en" :required-span="false" inputclass="dir_en"/>

                </div>

                <div class="row">
                    @foreach ( config('app.web_lang') as $key=>$lang )
                        <div class="col-lg-6 {{getColDir($key)}}">
                            <x-admin.form.trans-input
                                label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                                name="{{ $key }}[name]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.name"
                                value="{{old($key.'.name',$location->translateOrNew($key)->name)}}"
                            />
                            <x-admin.form.trans-text-area
                                label="{{ __('admin/form.des_'.$key)}} ({{ ($key) }})"
                                name="{{ $key }}[des]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.des"
                                value="{!! old($key.'.des',$location->translateOrNew($key)->des) !!}"
                            />
                        </div>
                    @endforeach
                </div>

                <x-admin.main.meta-tage  :body-h1="false" :breadcrumb="false"  :old-data="$location" :placeholder="false" />

                <hr>

                <div class="row">
                    <x-admin.form.check-active  :row="$location" name="is_active" page-view="{{$pageData['ViewType']}}"/>
                    <x-admin.form.check-active  :row="$location" name="is_searchable" :defstatus="false" lable="{{ __('admin/project.searchable') }}" page-view="{{$pageData['ViewType']}}"/>
                    <x-admin.form.check-active  :row="$location" name="is_home" lable="عرض فى الصفحة الرئيسية" page-view="{{$pageData['ViewType']}}"/>
                </div>

                <hr>
                <x-admin.form.upload-model-photo :page-data="$pageData" :row="$location" />
                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>


@endsection


@push('JsCode')
    <x-admin.form.ckeditor-jave />
@endpush



