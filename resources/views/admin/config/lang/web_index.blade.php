@extends('admin.layouts.app')
@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="true"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :page-data="$pageData"/>

  <x-admin.hmtl.section>
    <div class="content mb-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-9">
            <x-admin.form.select-arr :send-arr="config('adminLangFile.webFile')" name="selectfile" :sendvalue="$selId"
                                     :label="__('admin.lang_select_file')"  print-val-name="name_{{thisCurrentLocale()}}" :labelview="false"/>
          </div>

          @if(config('app.development'))
            <div class="col-3 dir_button">
              <x-admin.form.action-button url="{{route('weblang.edit')}}" print-lable="{{__('admin.lang_add_new_key')}}" size="m"
                                          :tip="false" bg="dark"/>
            </div>
          @endif

        </div>
      </div>
    </div>


  </x-admin.hmtl.section>

  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">

      @if(count($rowData)>0)
        <div class="card-body table-responsive p-0">
          <table id="MainDataTable" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Key</th>
              @foreach(config('app.admin_lang') as $key =>$lang)
                <th>{{$lang}}</th>
              @endforeach
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($rowData as $row)
              <tr>
                <td class="TD_100">{{$row['keyVar']}}</td>
                @foreach(config('app.admin_lang') as $key =>$lang)
                  <th class="TD_300">{!! $row['name_'.$key] !!}</th>
                @endforeach
                <td class="TD_20">
                  <a href="#" thisid="custmid_{{$loop->index}}" class="btn btn-sm btn-primary copyThisText"><i
                     class="fa fas fa-copy"></i></a>
                  <input value="__('{{$row['prefixCopy']}}')" id="custmid_{{$loop->index}}" type="hidden">
                </td>

                <td class="TD_20">
                  <a href="#" thisid="Newcustmid_{{$loop->index}}" class="btn btn-sm btn-dark copyThisText"><i
                     class="fa fas fa-copy"></i></a>
                  <input value="{{$row['prefixCopy']}}" id="Newcustmid_{{$loop->index}}" type="hidden">
                </td>

              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @else
        <x-admin.hmtl.alert-massage type="nodata"/>
      @endif
    </x-admin.card.def>
  </x-admin.hmtl.section>

@endsection

@push('JsCode')
  <script>
      $('#selectfile').change(function () {
          var idSel = this.value;
          window.location = "{{ route('weblang.index','id=') }}" + idSel;
      });
  </script>
  <x-admin.data-table.plugins :jscode="true" :is-active="true" :page-length="25"/>
  <x-admin.jave.copy-this-text/>
@endpush

