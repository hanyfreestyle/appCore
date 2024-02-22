@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        @if($pageData['ViewType'] == 'List')
            <x-admin.realestate.check-data-button :row="$Projects" :slug="false"/>
        @endif
        <x-admin.card.def  :page-data="$pageData" >
            @if(count($Projects)>0)
                <div class="card-body table-responsive p-0">
                    <table  {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        @include('admin.project.index_header')
                        <tbody>
                        @foreach($Projects as $Project)
                            <tr>
                                <td>{{$Project->id}}</td>
                                <td>{!! TablePhoto($Project) !!} </td>
                                <td>{{optional($Project->translate('ar'))->name}}</td>
                                <td>{{optional($Project->translate('en'))->name}}</td>
                                <td>{!! is_active($Project->is_published) !!}</td>
                                @if($pageData['ViewType'] == 'deleteList')
                                    <x-admin.table.soft-delete type="b" :row="$Project" />
                                @else
                                    <x-admin.table.action-but type="addLang" :row="$Project" />
                                    <x-admin.table.action-but type="OldPhotos" :row="$Project" />
                                    <x-admin.table.action-but type="ProjectBut" :row="$Project" />
                                    <x-admin.table.action-but type="edit" :row="$Project" />
                                    <x-admin.table.action-but type="delete" :row="$Project" />
                                    <td class="td_action"><x-admin.form.action-button url="{{route('page_ListView',$Project->slug)}}" bg="dark" icon="fa fa-eye" :target="true"/></td>
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
        <x-admin.hmtl.pages-link :row="$Projects" />

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="$viewDataTable" />
@endpush


