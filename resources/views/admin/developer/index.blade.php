@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable" />
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>

        <div class="row">
            <div class="col-lg-12 mb-2">
                <x-admin.realestate.check-data-button  :row="$Developers" />
            </div>
        </div>

        <x-admin.card.def  :page-data="$pageData" >
            @if(count($Developers)>0)
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th class="TD_20"></th>
                            <th>{{__('admin/def.form_name_ar')}}</th>
                            <th>{{__('admin/def.form_name_en')}}</th>
                            <th class="TD_20">{{__('admin/project.t_project')}}</th>
                            <th class="TD_20">{{__('admin/project.t_units')}}</th>
                            <th class="TD_20"></th>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="delete"/>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Developers as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td class="tc">{!! TablePhoto($row,'photo') !!} </td>
                                <td>{{optional($row->translate('ar'))->name }}</td>
                                <td>{{optional($row->translate('en'))->name}}</td>
                                <td>{{$row->projects_count}}</td>
                                <td>{{$row->units_count}}</td>
                                <td >{!! is_active($row->is_active) !!}</td>
                                <x-admin.table.action-but type="Photos" :row="$row" />
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
        <x-admin.hmtl.pages-link :row="$Developers" />

   </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable" />
@endpush

