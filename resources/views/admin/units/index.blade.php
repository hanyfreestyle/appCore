@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
        <x-admin.hmtl.section>
            <div class="row mb-3">
                <div class="col-9"><h1 class="def_h1_new">{!! print_h1($Project) !!}</h1></div>
                <div class="col-3 dir_button"><x-admin.form.action-button url="{{route($PrefixRoute.'.index',$Project->id)}}" type="units" /></div>
            </div>
       </x-admin.hmtl.section>

        <x-admin.hmtl.section>
            @if($pageData['ViewType'] == 'List')
                <x-admin.realestate.check-data-button :row="$Units" :slug="false" :subid="$Project->id"/>
            @endif
       </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.def  :page-data="$pageData" >
            @if(count($Units)>0)
                <div class="card-body table-responsive p-0">
                    <table  {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th class="TD_20"></th>
                            <th class="TD_350">{{__('admin/def.form_name_ar')}}</th>
                            <th class="TD_350">{{__('admin/def.form_name_en')}}</th>

                            @if($pageData['ViewType'] == 'deleteList')
                                <x-admin.table.soft-delete />
                            @else
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="delete"/>
                                <th class="td_action"></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Units as $Unit)
                            <tr>
                                <td>{{$Unit->id}}</td>
                                <td class="tc">{!! TablePhoto($Unit) !!} </td>
                                <td>{{optional($Unit->translate('ar'))->name}}</td>
                                <td>{{optional($Unit->translate('en'))->name}}</td>

                                @if($pageData['ViewType'] == 'deleteList')
                                    <x-admin.table.soft-delete type="b" :row="$Unit" />
                                @else
                                    <td class="td_action">{!! is_active($Unit->is_published) !!}</td>
                                    <x-admin.table.action-but type="addLang" :row="$Unit" :modelid="$Unit->parent_id" />
                                    <x-admin.table.action-but type="OldPhotos" :row="$Unit" :modelid="$Unit->parent_id" />
                                    <x-admin.table.action-but type="Photos" :row="$Unit" :modelid="$Unit->parent_id" />
                                    <x-admin.table.action-but type="edit" :row="$Unit" :modelid="$Unit->parent_id" />
                                    <x-admin.table.action-but type="delete" :row="$Unit" :modelid="$Unit->parent_id" />
                                    <td class="td_action"><x-admin.form.action-button url="{{route('page_ListView',$Unit->slug)}}" bg="dark" icon="fa fa-eye" :target="true"  /></td>
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

        <x-admin.hmtl.pages-link :row="$Units" />

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="$viewDataTable" />
@endpush
