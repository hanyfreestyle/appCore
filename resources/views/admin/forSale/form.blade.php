@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"  />
    @if($pageData['ViewType'] == 'Edit')
        <x-admin.hmtl.section>
            <div class="row mb-3">
                <div class="col-7">
                    <h1 class="def_h1_new">{!! print_h1($Unit) !!}</h1>
                </div>
                <div class="col-5 dir_button">
                    <x-admin.lang.delete-button :row="$Unit" />

                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.Old_Photos', $Unit->id)}}" :viewbut="$Unit->slider_active" type="old"  :tip="false" />
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$Unit->id)}}" type="morePhoto" :tip="false"  />
                </div>
            </div>
        </x-admin.hmtl.section>
    @endif

    <x-admin.hmtl.section>

        <x-admin.card.def :page-data="$pageData"  >

            <form  class="mainForm" action="{{route($PrefixRoute.'.update',intval($Unit->id))}}" method="post"  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <x-admin.form.input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-6 {{getColDir('en')}}" value="{{old('slug',$Unit->slug)}}"  dir="en" inputclass="dir_en"/>
                    <x-admin.form.select-arr  name="developer_id" label="{{__('admin/project.developer')}}" :sendvalue="old('developer_id',$Unit->developer_id)" :required-span="true" colrow="col-lg-3 " :send-arr="$CashDeveloperList"/>
                    <x-admin.form.select-arr  name="location_id" label="{{__('admin/project.loction')}}" :sendvalue="old('location_id',$Unit->location_id)" :required-span="true" colrow="col-lg-3 " :send-arr="$CashLocationList"/>
                </div>

                <div class="row">
                    <x-admin.form.select-arr  :labelview="false" name="property_type" label="{{__('admin/project.property_type')}}" :sendvalue="old('property_type',$Unit->property_type)" :required-span="true" colrow="col-lg-3 " :send-arr="$Property_TypeArr"/>
                    <x-admin.form.select-arr  :labelview="false" name="view" label="{{__('admin/project.view')}}" :sendvalue="old('view',$Unit->view)" :required-span="true" colrow="col-lg-2 " :send-arr="$ListingView_Arr"/>
                    <x-admin.form.select-arr  :labelview="false" name="unit_status" label="{{ __('admin/project.unit_status') }}" :sendvalue="old('unit_status',$Unit->unit_status)" :required-span="true" colrow="col-lg-2 " :send-arr="$UnitSatues_Arr"/>

                    <x-admin.form.input label="{{__('admin/project.delivery_date')}}" name="delivery_date" colrow="col-lg-2 {{getColDir('en')}}"
                                        value="{{old('delivery_date',$Unit->delivery_date)}}"  inputclass="dir_en" :labelview="false" :placeholder="true" />
                    <x-admin.form.input label="{{__('admin/project.price')}}" name="price" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                                        value="{{old('price',$Unit->price)}}"  dir="ar" inputclass="dir_en" :labelview="false" :placeholder="true"/>
                </div>


                <div class="row">
                    <x-admin.form.input label="{{__('admin/project.area')}}" name="area" :requiredSpan="true" colrow="col-lg-2 {{getColDir('en')}}"
                                        value="{{old('area',$Unit->area)}}"  dir="ar" inputclass="dir_en" :labelview="false" :placeholder="true"/>

                    <x-admin.form.input label="{{__('admin/project.rooms')}}" name="rooms" :requiredSpan="true" colrow="col-lg-2 {{getColDir('en')}}"
                                        value="{{old('rooms',$Unit->rooms)}}"  dir="ar" inputclass="dir_en" :labelview="false" :placeholder="true"/>

                    <x-admin.form.input label="{{__('admin/project.baths')}}" name="baths" :requiredSpan="true" colrow="col-lg-2 {{getColDir('en')}}"
                                        value="{{old('baths',$Unit->baths)}}"  dir="ar" inputclass="dir_en" :labelview="false" :placeholder="true"/>

                    <x-admin.form.input label="Latitude" name="latitude" :requiredSpan="false" colrow="col-lg-2 {{getColDir('en')}}"
                                        value="{{old('latitude',$Unit->latitude)}}"  dir="ar" inputclass="dir_en" :labelview="false" :placeholder="true"/>

                    <x-admin.form.input label="Longitude" name="longitude" :requiredSpan="false" colrow="col-lg-2 {{getColDir('en')}}"
                                        value="{{old('longitude',$Unit->longitude)}}"  dir="ar" inputclass="dir_en" :labelview="false" :placeholder="true"/>

                    <x-admin.form.input label="{{__('admin/project.youtube')}}" name="youtube_url" :requiredSpan="false" colrow="col-lg-2"
                                        value="{{old('youtube_url',$Unit->youtube_url )}}"  dir="ar"  :labelview="false" :placeholder="true"/>
                </div>


                <div class="row">
                    <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
                    @foreach ( $LangAdd as $key=>$lang )
                        <x-admin.lang.meta-tage-filde :row="$Unit" :key="$key" :viewtype="$pageData['ViewType']"  />
                    @endforeach
                </div>

                <x-admin.realestate.amenity :send-data="$Unit->amenity" />

                <div class="row">
                    <x-admin.form.check-active  :row="$Unit" lable="{{__('admin/form.is_published')}}" name="is_published" page-view="{{$pageData['ViewType']}}"/>
                </div>

                <hr>
                <x-admin.form.upload-model-photo :page-data="$pageData" :row="$Unit" />
                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>


@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.form.ckeditor-jave height="350" />
@endpush
