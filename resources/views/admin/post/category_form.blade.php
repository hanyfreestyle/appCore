@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">

            <form  class="mainForm" action="{{route($PrefixRoute.'.update',intval($Category->id))}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-admin.form.input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-12 {{getColDir('en')}}"
                                        value="{{old('slug',$Category->slug)}}"  dir="en" inputclass="dir_en"/>
                </div>

                <div class="row">
                    @foreach ( config('app.web_lang') as $key=>$lang )
                        <div class="col-lg-6 {{getColDir($key)}}">
                            <x-admin.form.trans-input
                                label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                                name="{{ $key }}[name]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.name"
                                value="{{old($key.'.name',$Category->translateOrNew($key)->name)}}"
                            />
                        </div>
                    @endforeach
                </div>

                <x-admin.main.meta-tage   :old-data="$Category" :placeholder="false" />

                <hr>

                <div class="row">
                    <x-admin.form.check-active  :row="$Category" name="is_active" page-view="{{$pageData['ViewType']}}"/>
                </div>

                <hr>
{{--                <x-admin.form.upload-model-photo :page-data="$pageData" :row="$Category" />--}}
                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection
