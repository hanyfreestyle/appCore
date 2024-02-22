@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        @if($pageData['ViewType'] == 'List')
            <x-admin.realestate.check-data-button  :row="$Units" :slug="false"/>
        @endif

        <x-admin.card.def  :page-data="$pageData" >

            @if(count($Units)>0)
                <div class="card-body table-responsive p-0">
                    <table {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        @include('admin.forSale.index_header')
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
                                    <x-admin.table.action-but type="addLang" :row="$Unit" />
                                    <x-admin.table.action-but type="OldPhotos" :row="$Unit" />
                                    <x-admin.table.action-but type="Photos" :row="$Unit" />
                                    <x-admin.table.action-but type="edit" :row="$Unit" />
                                    <x-admin.table.action-but type="delete" :row="$Unit" />
                                    <td class="td_action"><x-admin.form.action-button url="{{route('page_ListView',$Unit->slug)}}" :tip="true" bg="dark" icon="fa fa-eye" :target="true"  /></td>
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


