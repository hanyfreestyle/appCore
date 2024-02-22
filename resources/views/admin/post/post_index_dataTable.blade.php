@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.realestate.check-data-button/>

        <x-admin.card.def  :page-data="$pageData" >
            <table {!! Table_Style($viewDataTable,$yajraTable) !!} >
                @include('admin.post.post_index_header')
                <tbody>
                </tbody>
            </table>
        </x-admin.card.def>

    </x-admin.hmtl.section>
@endsection


@push('JsCode')
    <x-admin.data-table.sweet-dalete/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="$viewDataTable" />
    <script>
        $(function () {
            var table = $('.DataTableView').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                // order: [0, 'desc'],
                @include('datatable.lang')
                ajax: "{{ route($PrefixRoute.'.DataTable') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'photo', name: 'photo',orderable: false, searchable: false},
                    {data: 'tablename.0.name', name: 'tablename.name'},
                    {data: 'tablename.1.name', name: 'tablename.name'},
                    {data: 'is_published', name: 'is_published',orderable: false, searchable: false},

                    @can($PrefixRole.'_edit')
                    {data: 'AddLang', name: 'AddLang', orderable: false, searchable: false},
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
