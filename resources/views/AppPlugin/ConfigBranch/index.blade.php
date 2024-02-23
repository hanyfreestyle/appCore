@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-12 text-left">
                <x-admin.form.action-button url="{{route('config.Branch.Sort')}}"  type="sort" :tip="false" />
            </div>
        </div>
        <x-admin.card.def :page-data="$pageData" >

            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th>{{__('admin/config/branch.title')}}</th>
                            @if($pageData['ViewType'] == 'deleteList')
                                <x-admin.table.soft-delete />
                            @else
                                <th>{{__('admin/config/branch.address')}}</th>
                                <th>{{__('admin/config/branch.phone')}}</th>
                                <th>{{__('admin/config/branch.work_hours')}}</th>
                                <th></th>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="delete"/>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->title}}</td>

                                @if($pageData['ViewType'] == 'deleteList')
                                    <x-admin.table.soft-delete type="b" :row="$row" />
                                @else
                                    <td>{!! nl2br($row->address) !!}</td>
                                    <td style="direction: ltr">{!! nl2br($row->phone) !!}</td>
                                    <td>{!! nl2br($row->work_hours) !!}</td>
                                    <td class="tc">{!! is_active($row->is_active) !!}</td>
                                    <x-admin.table.action-but type="edit" :row="$row" />
                                    <x-admin.table.action-but type="delete" :row="$row" />
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata" />
            @endif
        </x-admin.card.def>
        <x-admin.hmtl.pages-link :row="$rowData" />

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="$viewDataTable" />
@endpush
