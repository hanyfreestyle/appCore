@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.product.form-top-icon :page-data="$pageData" :row="$rowData"/>

  <div class="productForm">




    <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
      @csrf
      <x-admin.hmtl.section>
        @if($errors->has([]))
          <div class="alert alert-danger alert-dismissible">
            {{__('admin/alertMass.form_has_error')}}
          </div>
        @endif
        
        <div class="row mb-5">

          <x-admin.card.normal col="col-lg-9">
            <div class="row">
              <x-admin.form.select-multiple name="categories" :categories="$Categories" :sel-cat="$selCat" :col="9"/>
              <x-admin.form.select-arr name="brand_id" sendvalue="{{old('brand_id',$rowData->brand_id)}}" :required-span="false"
                                       :send-arr="$CashBrandList" label="{{__('admin/proProduct.app_menu_brand')}}" col="3"/>
            </div>

            <div class="row">
              <x-admin.product.form-price :row="$rowData"/>
            </div>

            <hr>
            <div class="row mt-2">
              <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
              <x-admin.product.form-content :lang-send="$LangAdd" :row="$rowData" :viewtype="$pageData['ViewType']" />
            </div>

          </x-admin.card.normal>

          <x-admin.card.normal col="col-lg-3">
            <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" :labelview="false" col="12"/>
          </x-admin.card.normal>


          <x-admin.form.submit-role-back :page-data="$pageData"/>


        </div>
      </x-admin.hmtl.section>


    </form>
  </div>





@endsection
{{--            <div class="row">--}}
{{--              <x-admin.form.check-active :row="$rowData" :lable="__('admin/form.check_is_published')" name="is_active"--}}
{{--                                         page-view="{{$pageData['ViewType']}}"/>--}}

{{--            </div>--}}

@push('JsCode')
  <x-admin.table.sweet-delete-js/>
  <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
  @if($viewEditor)
    <script src="https://cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>
    @foreach ( $LangAdd as $key=>$lang )
      <x-admin.java.ckeditor-by-name name="{{$key}}[des]" :dir="$key" height="250"/>
      <x-admin.java.ckeditor-by-name name="{{$key}}[short_des]" :dir="$key" height="250"/>
    @endforeach
  @endif
@endpush
