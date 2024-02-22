@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"  />

    <x-admin.hmtl.section>
        @if($pageData['ViewType'] == 'Edit')
            <div class="row mb-2">
                <div class="col-9">
                    <h1 class="def_h1_new">{!! print_h1($Post) !!}</h1>
                </div>
                <div class="col-3 dir_button">
                    <x-admin.lang.delete-button :row="$Post" />
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$Post->id)}}" type="morePhoto" :tip="false" bg="dark"  />
                </div>
            </div>
        @endif
    </x-admin.hmtl.section>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData"  >
            <form  class="mainForm" action="{{route($PrefixRoute.'.update',intval($Post->id))}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-admin.form.select-arr  name="category_id" :send-arr="$CashPostCategoryList" :sendvalue="old('category_id',$Post->category_id)" label="{{__('admin/form.category')}}" colrow="col-lg-4" :labelview="false" />
                    <x-admin.form.input name="slug"  label="Slug" value="{{old('slug',$Post->slug)}}"  colrow="col-lg-8" inputclass="dir_en" :labelview="false" :placeholder="true"/>
                </div>
                <div class="row">
                    <x-admin.form.select-arr  name="developer_id" :send-arr="$CashDeveloperList" :sendvalue="old('developer_id',$Post->developer_id)" label="{{__('admin/form.developer')}}" colrow="col-lg-4" :labelview="false" />
                    <x-admin.form.select-arr  name="location_id"  :send-arr="$CashLocationList"  :sendvalue="old('location_id',$Post->location_id)" label="{{__('admin/project.loction')}}"  colrow="col-lg-2" :labelview="false" />
                    <x-admin.form.select-arr  name="listing_id"  :send-arr="$CashCompoundList" select-type="changeLang" :sendvalue="old('listing_id',$Post->listing_id)" label="{{__('admin/page.mod_compound')}}"  colrow="col-lg-6" :labelview="false" />
                </div>

                <div class="row">
                    <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
                    @foreach ( $LangAdd as $key=>$lang )
                        <x-admin.lang.meta-tage-filde :row="$Post" :key="$key" :viewtype="$pageData['ViewType']"  />
                    @endforeach
                </div>
                <hr>
                <div class="row">
                    <x-admin.form.check-active  :row="$Post" lable="{{__('admin/form.is_published')}}" name="is_published" page-view="{{$pageData['ViewType']}}"/>
                </div>
                <hr>
                <x-admin.form.upload-model-photo :page-data="$pageData" :row="$Post" />
                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.form.ckeditor-jave height="350" />
@endpush
