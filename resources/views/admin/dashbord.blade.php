@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">

            </div>
        </div>
    </div>
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12 mb-lg-3 mb-3">
                <x-admin.form.action-button url="{{ route('admin.Dashboard.Update')  }}" bg="w" print-lable="{{__('admin/config/cash.btn_update')}}"  :tip="false"/>
            </div>
        </div>

        <div class="row">
            <x-admin.dashboard.count-list :card-count="$PostsCount" url="Blog.post" name="{{ __('admin/menu.post') }}"  />
            <x-admin.dashboard.count-list :card-count="$DevelopersCount" url="developer" name="{{ __('admin/menu.developer') }}"  lable="" />
            <x-admin.dashboard.count-list :card-count="$ProjectsCount" url="project" name="{{ __('admin/menu.project') }}"  lable="" />
            <x-admin.dashboard.count-list :card-count="$ProjectUnitsCount" :url="false" name="{{ __('admin/project.units_project_title') }}"  lable="" />
            <x-admin.dashboard.count-list :card-count="$ForSaleCount" url="project" name="{{ __('admin/menu.unit') }}"  lable="" />
        </div>
    </x-admin.hmtl.section>




@endsection

@push('JsCode')
@endpush
