@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="false"/>
@endsection

@section('content')

    <x-admin.hmtl.section>
        <x-admin.hmtl.breadcrumb-normal title="App Puzzle"/>
        <x-admin.card.normal >
            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!!Table_Style(false,false) !!} >
                        <thead>
                        <tr>
                            <th class="TD_100">CatId</th>
                            <th class="TD_100"></th>
                            <th class="TD_100"></th>
                            <th class="TD_100"></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row['id']}}</td>
                                <td class="td_action"><x-admin.form.action-button url="{{route('AppPuzzle.InfoModel',$row['id'])}}" print-lable="Update Code" :tip="false" icon="fas fa-search" /></td>
                                <td class="td_action"><x-admin.form.action-button url="{{route('AppPuzzle.Copy',$row['id'])}}" print-lable="Copy Files"  :tip="false" bg="dark" icon="fas fa-file-import"/></td>
                                <td class="td_action"><x-admin.form.action-button url="{{route('AppPuzzle.Remove',$row['id'])}}" print-lable="Delete Files"  :tip="false" bg="d" icon="fas fa-trash-alt"/></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata" />
            @endif
        </x-admin.card.normal>


    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="false" />
@endpush
