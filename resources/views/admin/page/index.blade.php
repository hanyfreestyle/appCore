@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>

        <div class="row">
            <div class="col-lg-9 mb-2">
                <x-admin.realestate.check-data-button  :slug="false" :photo="false" :row="$Pages" />
            </div>
        </div>

        <x-admin.card.def  :page-data="$pageData" >


            @if(count($Pages)>0)
                <div class="card-body table-responsive p-0">
                    <table {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>

                            <th class="TD_200">{{__('admin/def.form_name_ar')}}</th>
                            <th class="TD_200">{{__('admin/def.form_name_en')}}</th>
                            @if($pageData['ViewType'] == 'deleteList')
                                <x-admin.table.soft-delete />
                            @else
                                <th class="TD_150">{{__('admin/project.loction')}}</th>
                                <th class="TD_200">{{__('admin/page.mod_compound')}}</th>
                                <th class="TD_20"></th>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="delete"/>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Pages as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td><a href="{{\App\Http\Controllers\admin\PageAdminController::createPagesLink('ar',$row)}}" target="_blank">{{optional($row->translate('ar'))->name}}</a></td>
                                <td><a href="{{\App\Http\Controllers\admin\PageAdminController::createPagesLink('en',$row)}}" target="_blank">{{optional($row->translate('en'))->name}}</a></td>
                                @if($pageData['ViewType'] == 'deleteList')
                                    <x-admin.table.soft-delete type="b" :row="$row" />
                                @else
                                    <td><a href="{{route('pages.location_index',intval(optional($row->loaction)->id))}}">{{optional($row->loaction)->name}}</a></td>
                                    <td><a href="{{route('pages.compound_index',intval(optional($row->project)->id))}}">{{optional($row->project)->name}}</a></td>
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

        <x-admin.hmtl.pages-link :row="$Pages" />

   </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="$viewDataTable" />
@endpush


