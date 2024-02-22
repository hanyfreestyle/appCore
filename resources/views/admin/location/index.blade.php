@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-admin.card.def  :page-data="$pageData" >
            @if(count($locations)>0)
                <div class="card-body table-responsive p-0">
                    <table {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th class="TD_20"></th>
                            <th class="TD_150">{{__('admin/def.form_name_ar')}}</th>
                            <th class="TD_150">{{__('admin/def.form_name_en')}}</th>
                            <th class="TD_150">Parent</th>
                            <th class="TD_20">{{__('admin/project.t_project')}}</th>
                            <th class="TD_20">{{__('admin/project.t_units')}}</th>
                            <th class="TD_20"></th>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="delete"/>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($locations as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{!! TablePhoto($row,'photo') !!} </td>
                                <td>{{$row->translate('ar')->name ?? ''}}</td>
                                <td>{{$row->translate('en')->name ?? ''}}</td>
                                <td>
                                    @if($row->parent_id )
                                        {{ $row->parentName->translate('en')->name ?? '' }}
                                    @endif
                                </td>
                                <td>{{$row->projects_count}}</td>
                                <td>{{$row->units_count}}</td>
                                <td>{!! is_active($row->is_active) !!}</td>

                                <x-admin.table.action-but type="edit" :row="$row" />
                                <x-admin.table.action-but type="delete" :row="$row" />
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata" />
            @endif
        </x-admin.card.def>
        <x-admin.hmtl.pages-link :row="$locations" />
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="$viewDataTable" />
@endpush

