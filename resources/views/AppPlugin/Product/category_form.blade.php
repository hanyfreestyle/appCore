@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <x-admin.form.select-category name="parent_id" label="{{__('admin/form.sel_categories')}}"
                                        :sendvalue="old('parent_id',$rowData->parent_id)" :req="false" col="col-lg-6 "
                                        :send-arr="$Categories"
          />
        </div>

        <div class="row">
          <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
          @foreach ( $LangAdd as $key=>$lang )
            <x-admin.lang.meta-tage-filde :row="$rowData" :key="$key" :viewtype="$pageData['ViewType']" :label-view="false"/>
          @endforeach

        </div>

        <hr>
        <div class="row">
          <x-admin.form.check-active :row="$rowData" :lable="__('admin/form.check_is_published')" name="is_active"
                                     page-view="{{$pageData['ViewType']}}"/>

        </div>
        <hr>
        <div class="row">
          <x-admin.form.upload-model-photo :page-data="$pageData" :row="$rowData" col="7"/>
          <x-admin.form.upload-model-photo :page-data="$pageData" :row="$rowData" col='5' file="icon" filde="icon" filter="_iconfilterid"
                                           route=".emptyIcon" filter-name="IconFilter" />
        </div>


        {{--        <div class="row">--}}

        {{--          <div class="col-lg-8">--}}
        {{--            <x-admin.form.upload-file  view-type="{{$pageData['ViewType']}}" :row-data="$rowData"--}}
        {{--                                       :multiple="false"--}}
        {{--                                       thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,$controllerName.'_filterid',0) }}"--}}
        {{--                                       :emptyphotourl="$PrefixRoute.'.emptyPhoto'"  />--}}

        {{--          </div>--}}


        {{--          <div class="col-lg-4">--}}
        {{--            <x-admin.form.upload-file  view-type="{{$pageData['ViewType']}}" :row-data="$rowData"--}}
        {{--                                       :multiple="false"--}}
        {{--                                       file-name="icon"--}}
        {{--                                       fild-name="icon"--}}
        {{--                                       thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,$controllerName.'_iconfilterid',0) }}"--}}
        {{--                                       :emptyphotourl="$PrefixRoute.'.emptyPhoto'"  />--}}

        {{--          </div>--}}
        {{--        </div>--}}

        {{--            <x-admin.form.upload-file view-type="{{$pageData['ViewType']}}" :row-data="$rowData"--}}
        {{--                                      :multiple="false"--}}
        {{--                                      label="Icon"--}}
        {{--                                      :req="false"--}}
        {{--                                      fild-name="icon"--}}
        {{--                                      :add-filter-list="false"--}}
        {{--                                      :emptyphotourl="$PrefixRoute.'.emptyIcon'"  />--}}


        <x-admin.form.submit-role-back :page-data="$pageData"/>

      </form>

    </x-admin.card.def>
  </x-admin.hmtl.section>


@endsection


@push('JsCode')
  <x-admin.table.sweet-delete-js/>
  @if($viewEditor)
    <x-admin.form.ckeditor-jave height="350"/>
  @endif
@endpush
