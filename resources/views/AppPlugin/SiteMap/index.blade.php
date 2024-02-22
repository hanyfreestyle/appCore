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
            <x-admin.app-plugin.site-map.update-block catid="index" route="UpdateIndex" :row="$rowData" title="{{__('admin/config/sitemap.t_index')}}"  />
            <x-admin.app-plugin.site-map.update-block catid="developer" route="UpdateDeveloper" :row="$rowData" title="{{__('admin/config/sitemap.t_developer')}}"  />
            <x-admin.app-plugin.site-map.update-block catid="blog" route="UpdateBlog" :row="$rowData" title="{{__('admin/config/sitemap.t_blog')}}"  />
            <x-admin.app-plugin.site-map.update-block catid="listing_ar" route="UpdateListingAr" :row="$rowData" title="{{__('admin/config/sitemap.t_listing_ar')}}"  />
            <x-admin.app-plugin.site-map.update-block catid="listing_en" route="UpdateListingEn" :row="$rowData" title="{{__('admin/config/sitemap.t_listing_en')}}"  />
            <x-admin.app-plugin.site-map.update-block catid="for_sale" route="UpdateForSale" :row="$rowData" title="{{__('admin/config/sitemap.t_for_sale')}}"  />
        </div>
    </x-admin.hmtl.section>

@endsection

