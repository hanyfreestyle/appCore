@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
{{--  <x-admin.hmtl.section>--}}
{{--    @if($pageData['ViewType'] == 'Edit')--}}
{{--      <div class="row mb-2">--}}
{{--        <div class="col-9">--}}
{{--          <h1 class="def_h1_new">{!! print_h1($rowData) !!}</h1>--}}
{{--        </div>--}}
{{--        <div class="col-3 dir_button">--}}
{{--          <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$rowData->id)}}" type="morePhoto" :tip="false"/>--}}
{{--          <x-admin.lang.delete-button :row="$rowData"/>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    @endif--}}
{{--  </x-admin.hmtl.section>--}}


  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">

          @foreach ( config('app.web_lang') as $key=>$lang )
            <x-admin.form.trans-input name="name" :key="$key" :row="$rowData" :label="__('admin/form.text_name')" :tdir="$key" col="6"/>
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
