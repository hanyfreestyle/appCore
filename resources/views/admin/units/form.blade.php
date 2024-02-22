@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"  />

    <x-admin.hmtl.section>
        <div class="row mt-4 mb-3">
            <div class="col-lg-6">
                <h1 class="def_h1_new">{!! print_h1($Project) !!}</h1>
            </div>
            <div class="col-lg-6 dir_button">
                <x-admin.lang.delete-button :row="$Unit" />
                <x-admin.form.action-button url="{{route($PrefixRoute.'.index',$Project->id)}}" print-lable="{{__('admin/project.list_units')}}" icon="fas fa-bath" :tip="false" bg="p" />
                @if($pageData['ViewType'] == 'Edit')
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',[$Project->id,$Unit->id])}}" type="morePhoto" :tip="false" bg="dark" />
                @endif
            </div>
        </div>
   </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.def :pageData="$pageData" :full-error="true" >
            <form  class="mainForm" action="{{route($PrefixRoute.'.update',intval($Unit->id))}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="parent_id" value="{{$Project->id}}">
                <input type="hidden" name="developer_id" value="{{$Project->developer_id}}">
                <input type="hidden" name="location_id" value="{{$Project->location_id}}">
                <input type="hidden" name="delivery_date" value="{{$Project->delivery_date}}">


                <div class="row">
                    <x-admin.form.input label="Slug" name="slug" colrow="col-lg-5 {{getColDir('en')}}" value="{{old('slug',$Unit->slug)}}"  inputclass="dir_en"/>
                    <x-admin.form.select-arr  :send-arr="$Property_TypeArr" name="property_type" label="{{__('admin/project.property_type')}}" :sendvalue="old('property_type',$Unit->property_type)" colrow="col-lg-3" />
                    <x-admin.form.lable-print :title="__('admin/project.developer')" :des="$Project->developerName->name" col="col-lg-2"/>
                    <x-admin.form.lable-print :title="__('admin/project.loction')" :des="$Project->locationName->name" col="col-lg-2" />
                </div>

                <div class="row">

                    <x-admin.form.select-arr  name="view" :send-arr="$ListingView_Arr" :sendvalue="old('view',$Unit->view)" label="{{__('admin/project.view')}}"  colrow="col-lg-2" :labelview="false" />
                    <x-admin.form.select-arr  name="unit_status" :send-arr="$UnitSatues_Arr" :sendvalue="old('unit_status',$Unit->unit_status)"   label="{{ __('admin/project.unit_status') }}" :labelview="false" colrow="col-lg-2" />
                    <x-admin.form.input name="price" value="{{old('price',$Unit->price)}}" label="{{__('admin/project.price')}}"  inputclass="dir_en" :labelview="false" :placeholder="true"   colrow="col-lg-2"  />
                    <x-admin.form.input name="area"  value="{{old('area',$Unit->area)}}"   label="{{__('admin/project.area')}}"  colrow="col-lg-2" :labelview="false" :placeholder="true"  dir="ar" inputclass="dir_en"/>
                    <x-admin.form.input name="rooms" value="{{old('rooms',$Unit->rooms)}}" label="{{__('admin/project.rooms')}}"  colrow="col-lg-2" :labelview="false" :placeholder="true"    dir="ar" inputclass="dir_en"/>
                    <x-admin.form.input name="baths" value="{{old('baths',$Unit->baths)}}" label="{{__('admin/project.baths')}}" colrow="col-lg-2" :labelview="false" :placeholder="true"    dir="ar" inputclass="dir_en"/>

                </div>

                <div class="row">
                    <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
                    @foreach ( $LangAdd as $key=>$lang )
                        <x-admin.lang.meta-tage-filde :row="$Unit" :key="$key" :viewtype="$pageData['ViewType']"  />
                    @endforeach
                </div>
                <hr>
                <div class="row">
                    <x-admin.form.check-active  :row="$Unit" lable="{{__('admin/form.is_published')}}" name="is_published" page-view="{{$pageData['ViewType']}}"/>
                </div>


                <x-admin.form.upload-file view-type="{{$pageData['ViewType']}}" :row-data="$Unit"
                                          :multiple="false"
                                          thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,$controllerName.'_filterid',0) }}"
                                          :emptyphotourl="$PrefixRoute.'.emptyPhoto'"  />

                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>
        </x-admin.card.def>
   </x-admin.hmtl.section>

@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.form.ckeditor-jave height="350" />
@endpush
