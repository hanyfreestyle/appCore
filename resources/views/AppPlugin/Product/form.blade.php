@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
        @if($pageData['ViewType'] == 'Edit')
          <div class="row mb-2">
            <div class="col-9">
              <h1 class="def_h1_new">{!! print_h1($rowData) !!}</h1>
            </div>
            <div class="col-3 dir_button">
              <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$rowData->id)}}" type="morePhoto" :tip="false"  />
              <x-admin.lang.delete-button :row="$rowData"/>
            </div>
          </div>
        @endif
  </x-admin.hmtl.section>


  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <x-admin.form.select-multiple name="categories">
            @foreach($Categories as $Category )
              <option value="{{$Category->id}}"
               {{ (in_array($Category->id,$selCat)) ? 'selected' : ''}}
               {{ (collect(old('categories'))->contains($Category->id)) ? 'selected':'' }}>{{$Category->name}}</option>
            @endforeach
          </x-admin.form.select-multiple>
        </div>


        <div class="row">
          <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
          @foreach ( $LangAdd as $key=>$lang )
            <x-admin.lang.meta-tage-filde :row="$rowData" :key="$key" :viewtype="$pageData['ViewType']" :label-view="$viewLabel"/>
          @endforeach
        </div>

        <hr>
        <div class="row">
          <x-admin.form.check-active :row="$rowData" :lable="__('admin/form.check_is_published')" name="is_active"
                                     page-view="{{$pageData['ViewType']}}"/>

        </div>
        <hr>
        <div class="row">
          <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="6"/>
        </div>

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
  @if($pageData['ViewType'] == "Add")
    <script type="text/javascript">
        var input1 = document.getElementById('name_ar');
        var input2 = document.getElementById('slug_ar');

        input1.addEventListener('change', function () {
            input2.value = input1.value;
        });

        var input3 = document.getElementById('name_en');
        var input4 = document.getElementById('slug_en');

        input3.addEventListener('change', function () {
            input4.value = input3.value;
        });
    </script>
  @endif

@endpush