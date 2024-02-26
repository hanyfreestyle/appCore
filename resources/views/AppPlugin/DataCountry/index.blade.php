@extends('admin.layouts.app')
@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <x-admin.main.filter-form form-name="{{$formName}}" :row="$rowData" :export-view="false" :from-date="false" :to-date="false"
                              :is-active="true" :continent="true"/>

    <x-admin.card.def :page-data="$pageData">
      @if(count($rowData)>0)
        <div class="card-body table-responsive p-0">
          <table {!!Table_Style($viewDataTable,$yajraTable) !!} >
            <thead>
            <tr>
              <th class="TD_20">#</th>
              <th class="TD_20"></th>
              <th class="TD_20">ISO2</th>
              <th class="TD_20">ISO3</th>
              <th class="TD_20">Code</th>
              <th class="TD_20">Symbol</th>
              <th class="TD_100">{{__('admin/dataCountry.t_name')}}</th>
              <th class="TD_100">{{__('admin/dataCountry.t_capital')}}</th>
              <th class="TD_100">{{__('admin/dataCountry.t_currency')}}</th>
              <th class="TD_100">{{__('admin/dataCountry.t_continent')}}</th>
              @if($pageData['ViewType'] == 'deleteList')
                <x-admin.table.soft-delete/>
              @else
                <x-admin.table.action-but po="top" type="edit"/>
                <x-admin.table.action-but po="top" type="edit"/>
                <x-admin.table.action-but po="top" type="delete"/>
              @endif
            </tr>
            </thead>
            <tbody>

            @foreach($rowData as $row)
              <tr>
                <td>{{$row->id}}</td>
                <td>{!! TablePhotoFlag($row) !!} </td>
                <td>{{$row->iso2}}</td>
                <td>{{$row->iso3}}</td>
                <td>{{$row->phone}}</td>
                <td>{{$row->symbol}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->capital}}</td>
                <td>{{$row->currency}}</td>
                <td>{{$row->continent}}</td>
                @if($pageData['ViewType'] == 'deleteList')
                  <x-admin.table.soft-delete type="b" :row="$row"/>
                @else
                  <x-admin.ajax.update-status-but :row="$row"/>
                  <x-admin.table.action-but type="edit" :row="$row"/>
                  <x-admin.table.action-but type="delete" :row="$row"/>
                @endif
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @else
        <x-admin.hmtl.alert-massage type="nodata"/>
      @endif
    </x-admin.card.def>
    <x-admin.hmtl.pages-link :row="$rowData"/>

  </x-admin.hmtl.section>
@endsection

@push('JsCode')
  <x-admin.table.sweet-delete-js/>
  <x-admin.ajax.update-status-but-code url="{{ route($PrefixRoute.'.updateStatus') }}"/>
  <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
@endpush
