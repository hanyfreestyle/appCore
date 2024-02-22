@extends('web.layouts.app')
@section('content')
    <x-site.def.breadcrumbs>
        {{ Breadcrumbs::render('ForSale') }}
    </x-site.def.breadcrumbs>


    <div class="bg-primary-5p def_pb_100">
        <div class="container">
            <div class="row developer_view mb-5">

                <div class="col-md-12 text-centerX ">
                    <h1 class="h1_def h1_def_en text-centerX mt-3">
                        {!! __('web/compound.breadcrumbs_for_sale') !!} -
                        {{$units->total()}} {{ __('web/compound.h1_properties') }}
                    </h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4 order-lg-1 order-2">
                    <x-site.search.right-side  route="{{route('page_for_sale')}}" :developer="false" :project="false" />

                    <ul class="pages_link_list">
                        @foreach($PagesLinks as $pageLink)
                            <li><a href="{{\App\Http\Controllers\admin\PageAdminController::createPagesLink(thisCurrentLocale(),$pageLink)}}">{{$pageLink->name}}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-8 order-lg-2 order-1 ListProjectUnitsCard">
                    <div class="row">
                        @foreach($units as $unit)
                            <x-site.unit.card-list :unit="$unit" removefrom="liveWire"  />
                        @endforeach
                    </div>
                    <x-site.def.pagination :rows="$units"/>
                </div>

            </div>
        </div>
    </div>
@endsection
