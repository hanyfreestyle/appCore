@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>

        <x-admin.card.normal title="{{__('admin/config/cash.card_db_title')}}">
            <div class="row">
                @if(Session::has('DbUpdate.Done'))
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissible">
                            {!! __('admin/alertMass.confirm_update') !!}
                        </div>
                    </div>
                @endif
                <x-admin.cash.db-box key="Developer" :row="$setting"/>
                <x-admin.cash.db-box key="Location" :row="$setting"/>
                <x-admin.cash.db-box key="Project" :row="$setting"/>
            </div>
        </x-admin.card.normal>

        @if($KeyCount > 0 )
            <x-admin.card.normal title="{{__('admin/config/cash.card_cash_title')}}">
                <x-admin.hmtl.confirm-massage/>
                <div class="row">
                    <x-admin.cash.clear-box key="CashLocationList" title="{{__('admin/config/cash.t_location')}}" icon="fas fa-map-marker-alt" />
                    <x-admin.cash.clear-box key="CashDeveloperList" title="{{__('admin/config/cash.t_developer')}}" icon="fas fa-truck-monster" />
                    <x-admin.cash.clear-box key="CashAmenityList" title="{{__('admin/config/cash.t_amenity')}}" icon="fas fa-swimming-pool" />
                    <x-admin.cash.clear-box key="CashPagesList" title="{{__('admin/config/cash.t_page_list')}}" icon="fab fa-html5" />
                    <x-admin.cash.clear-box key="CashCompoundList" title="{{__('admin/config/cash.t_compound_list')}}" icon="fas fa-building" />
                    <x-admin.cash.clear-box key="PostCategoryList" title="{{__('admin/config/cash.t_post_category_list')}}" icon="fas fa-sitemap" />
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{route('config.update.ClearAll')}}" method="post">
                            @csrf
                            <x-admin.form.submit text="{{__('admin/config/cash.btn_clear_all')}}"/>
                        </form>
                    </div>
                </div>

            </x-admin.card.normal>
        @endif
    </x-admin.hmtl.section>
@endsection
