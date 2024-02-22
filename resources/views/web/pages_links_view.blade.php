@extends('web.layouts.app')
@section('content')

    <x-site.def.breadcrumbs>
        {{ Breadcrumbs::render('ForSale') }}
    </x-site.def.breadcrumbs>


    <div class="bg-primary-5p def_pb_100s">
        <div class="container">
            <div class="row developer_view mb-5">

                <div class="col-md-12 text-centerX ">
                    <h1 class="h1_def h1_def_en text-centerX mt-3">
                        {!! $page->name !!} -
                        {{$units->total()}} {{ __('web/compound.h1_properties') }}
                    </h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8 ListProjectUnitsCard">
                    <div class="row">
                        @foreach($units as $unit)
                            <x-site.unit.card-list :unit="$unit" removefrom="liveWire" />
                        @endforeach
                    </div>
                    <x-site.def.pagination :rows="$units"/>
                </div>
                <div class="col-md-4">
                    @if(count($PagesLinks)>0)
                        <h2 class="pages_link_list_h">{{__('web/def.near_by_area')}}</h2>

                        <ul class="pages_link_list">
                            @foreach($PagesLinks as $pageLink)
                                <li><a href="{{\App\Http\Controllers\admin\PageAdminController::createPagesLink(thisCurrentLocale(),$pageLink)}}">{{$pageLink->name}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                        <x-site.search.right-side />
                </div>
            </div>
        </div>
    </div>

    <div class="bg-primary-5p def_pb_100">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 text-centerX ">
                    {!! $page->des !!}

                </div>
            </div>
        </div>
    </div>

@endsection
