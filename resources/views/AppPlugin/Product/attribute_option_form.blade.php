@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <div class="row mb-3">
      <div class="col-7">
        <h1 class="def_h1_new">{!! print_h1($Attribute) !!}</h1>
      </div>
    </div>
  </x-admin.hmtl.section>


  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="attribute_id" value="{{$Attribute->id}}">
        <div class="row">
          @foreach ( config('app.web_lang') as $key=>$lang )
            <div class="col-lg-6">
              <x-admin.form.trans-input name="name" :key="$key" :row="$rowData" :label="__('admin/form.text_name')" :tdir="$key" col="12"/>
              <x-admin.form.trans-input name="slug" :key="$key" :row="$rowData" label="Slug" :tdir="$key" col="12"/>
            </div>
          @endforeach
        </div>

        <hr>
        <div class="row">
          <x-admin.form.check-active :row="$rowData" :lable="__('admin/form.check_is_published')" name="is_active"
                                     page-view="{{$pageData['ViewType']}}"/>

        </div>
        <hr>
        <x-admin.form.submit-role-back :page-data="$pageData"/>
     </form>

    </x-admin.card.def>
  </x-admin.hmtl.section>


@endsection


@push('JsCode')
  <x-admin.table.sweet-delete-js/>
  <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
  @if($viewEditor)
    <x-admin.form.ckeditor-jave height="350"/>
  @endif
@endpush
