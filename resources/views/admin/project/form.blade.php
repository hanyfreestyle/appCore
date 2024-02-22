@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"  />

    @if($pageData['ViewType'] == 'Edit')
        <x-admin.hmtl.section>
            <div class="row mb-3">
                <div class="col-7">
                    <h1 class="def_h1_new">{!! print_h1($Project) !!}</h1>
                </div>
                <div class="col-5 dir_button">
                    <x-admin.lang.delete-button :row="$Project" />
                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.Old_Photos', $Project->id)}}" :viewbut="$Project->slider_active" type="old"  :tip="false" />
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$Project->id)}}" type="morePhoto" :tip="false"  />
                    <x-admin.form.action-button url="{{route('project.faq_list',$Project->id)}}" print-lable="FAQ" icon="fas fa-question" :tip="false" bg="dark" />
                </div>
            </div>
       </x-admin.hmtl.section>


    @endif

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" :full-error="true"  >


            <form  class="mainForm" action="{{route('project.update',intval($Project->id))}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-admin.form.select-arr  :send-arr="$CashDeveloperList" name="developer_id" label="{{__('admin/project.developer')}}" :sendvalue="old('developer_id',$Project->developer_id)"   colrow="col-lg-3 " :labelview="false" />
                    <x-admin.form.select-arr  :send-arr="$CashLocationList" name="location_id" label="{{__('admin/project.loction')}}" :sendvalue="old('location_id',$Project->location_id)" :required-span="true" colrow="col-lg-2 " :labelview="false"/>
                    <x-admin.form.select-arr  :send-arr="$ProjectType_Arr" name="project_type" label="{{__('admin/project.project_type')}}" :sendvalue="old('project_type',$Project->project_type)" :required-span="true" colrow="col-lg-2 " :labelview="false" />
                    <x-admin.form.input label="Slug" name="slug" colrow="col-lg-5" value="{{old('slug',$Project->slug)}}"  inputclass="dir_en" :placeholder="true" :labelview="false" />
                </div>


                <div class="row">
                    <x-admin.form.select-arr  :send-arr="$ProjectSatues_Arr" name="status" label="{{__('admin/project.project_status') }}" :sendvalue="old('status',$Project->status)" colrow="col-lg-2" :labelview="false" />
                    <x-admin.form.input name="delivery_date" value="{{old('delivery_date',$Project->delivery_date)}}" label="{{__('admin/project.delivery_date')}}"  colrow="col-lg-2" inputclass="dir_en" :labelview="false" :placeholder="true" />
                    <x-admin.form.input name="price" value="{{old('price',$Project->price)}}" label="{{__('admin/project.price')}}" colrow="col-lg-2" inputclass="dir_en" :labelview="false" :placeholder="true" />
                    <x-admin.form.input name="latitude" value="{{old('latitude',$Project->latitude)}}" label="Latitude" colrow="col-lg-2" inputclass="dir_en" :labelview="false" :placeholder="true" />
                    <x-admin.form.input name="longitude" value="{{old('longitude',$Project->longitude)}}" label="Longitude" colrow="col-lg-2" inputclass="dir_en" :labelview="false" :placeholder="true" />
                    <x-admin.form.input name="youtube_url" value="{{old('youtube_url',$Project->youtube_url)}}" label="{{__('admin/project.youtube')}}" colrow="col-lg-2" inputclass="dir_en" :labelview="false" :placeholder="true" />
                </div>

                <div class="row">
                    <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
                    @foreach ( $LangAdd as $key=>$lang )
                        <x-admin.lang.meta-tage-filde  :row="$Project" :key="$key" :viewtype="$pageData['ViewType']"  />
                    @endforeach
                </div>

                <x-admin.realestate.amenity :send-data="$Project->amenity" />

                <div class="row">
                    <x-admin.form.check-active :row="$Project" lable="{{__('admin/form.is_published')}}" name="is_published" page-view="{{$pageData['ViewType']}}"/>
                </div>

                <hr>
                <x-admin.form.upload-model-photo :page-data="$pageData" :row="$Project" />
                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>

        </x-admin.card.def>
   </x-admin.hmtl.section>
@endsection



@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.form.ckeditor-jave height="350" />
@endpush
