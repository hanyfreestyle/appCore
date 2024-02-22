@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12 mb-2">
                <x-admin.realestate.check-data-button />
            </div>
        </div>

        <x-admin.card.def  :page-data="$pageData" >
            <table {!! Table_Style($viewDataTable,$yajraTable) !!} >
                @include('admin.developer.index_header')
                <tbody>
                </tbody>
            </table>
        </x-admin.card.def>

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable" />
    <x-admin.data-table.sweet-dalete/>
    <script type="text/javascript">
        $(function () {
            var table = $('.DataTableView').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                order: [0, 'desc'],
                @include('datatable.lang')
                ajax: "{{ route($PrefixRoute.'.DataTable') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'photo', name: 'photo',orderable: false, searchable: false},
                    {data: 'tablename.0.name', name: 'tablename.name'},
                    {data: 'tablename.1.name', name: 'tablename.name'},

                    {data: 'projects_count', name: 'projects_count',searchable: false},
                    {data: 'units_count', name: 'units_count',searchable: false},
                    {data: 'is_active', name: 'is_active',orderable: false, searchable: false},

                        @can($PrefixRole.'_edit')
                    {data: 'MorePhoto', name: 'MorePhoto', orderable: false, searchable: false},
                    {data: 'Edit', name: 'Edit', orderable: false, searchable: false},
                        @endcan

                        @can($PrefixRole.'_delete')
                    {data: 'Delete', name: 'Delete', orderable: false, searchable: false},
                    @endcan
                ]
            });
        });
    </script>
@endpush

