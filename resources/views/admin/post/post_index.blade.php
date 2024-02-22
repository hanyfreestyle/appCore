@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.realestate.check-data-button  :row="$Posts" />

        <x-admin.card.def  :page-data="$pageData" >
            @if(count($Posts)>0)
                <div class="card-body table-responsive p-0">
                    <table  {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        @include('admin.post.post_index_header')
                        <tbody>
                        @foreach($Posts as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td class="tc">{!! TablePhoto($row) !!} </td>
                                <td>{{optional($row->translate('ar'))->name}}</td>
                                <td>{{optional($row->translate('en'))->name}}</td>
                                @if($pageData['ViewType'] == 'deleteList')
                                    <x-admin.table.soft-delete type="b" :row="$row" />
                                @else
                                    <td>{!! is_active($row->is_published) !!}</td>
                                    <x-admin.table.action-but type="addLang" :row="$row" />
                                    <x-admin.table.action-but type="Photos" :row="$row" />
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
        <x-admin.hmtl.pages-link :row="$Posts" />

    </x-admin.hmtl.section>
@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="$viewDataTable" />
@endpush
