@extends('web.layouts.app')
@section('content')
    <x-site.def.breadcrumbs>
        {{ Breadcrumbs::render('CompoundsList') }}
    </x-site.def.breadcrumbs>

    <div class="bg-primary-5p def_pb_100X">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-centerX ">
                    <h1 class="h1_def h1_def_en text-centerX mt-3">
                        {!! __('web/compound.h1_title') !!} -
                        {{$projects->total()}} {{ __('web/compound.h1_compounds') }} -
                        {{$units->total()}} {{ __('web/compound.h1_properties') }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 ListProjectUnitsCard">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if(!isset($_GET['property_page'])) active @endif() "
                                    id="pills-project-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#pills-project"
                                    type="button"
                                    role="tab"
                                    aria-controls="pills-project"><span class="En_Font En_Font_number"> {{$projects->total()}}</span> {{__('web/compound.nav_compounds') }}  </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if(isset($_GET['property_page'])) active @endif()"
                                    id="pills-units-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#pills-units"
                                    type="button"
                                    role="tab"
                                    aria-controls="pills-units"><span class="En_Font En_Font_number">{{$units->total()}}</span> {{ __('web/compound.nav_properties') }}</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade @if(!isset($_GET['property_page'])) show active @endif() " id="pills-project" role="tabpanel" aria-labelledby="pills-project-tab">
                            <div class="row g-4 pb-5">
                                @foreach($projects as $project)
                                    <div class="col-lg-6 project_card_on_tab">
                                        <x-site.project.card-photo  :project="$project" cardstyle="project_side_bar" />
                                    </div>
                                @endforeach
                            </div>
                            <x-site.def.pagination :rows="$projects"/>
                        </div>

                        <div class="tab-pane fade @if(isset($_GET['property_page'])) show active @endif() " id="pills-units" role="tabpanel" aria-labelledby="pills-units-tab">
                            <div class="row">
                                @foreach($units as $unit)
                                    <x-site.unit.card-list  :unit="$unit" removefrom="liveWire" />
                                @endforeach
                            </div>
                            <x-site.def.pagination :rows="$units"/>
                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <x-site.search.right-side />
                </div>
            </div>
        </div>
    </div>

@endsection
