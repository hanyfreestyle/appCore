@extends('web.layouts.app')
@section('content')
    <x-site.def.breadcrumbs>
        {{ Breadcrumbs::render('developer_view',$developer) }}
    </x-site.def.breadcrumbs>

    <div class="bg-primary-5p def_pb_100 DeveloperView">
        <div class="container StopViewX">
            <div class="row developer_view mb-5">
                <div class="col-md-12 text-center ">
                    <div class="developer_img_div">
                        <x-site.def.img :row="$developer" def="developer" class="developer_list_img" w="300" h="300" />
                    </div>
                </div>

                <div class="col-md-12 text-center ">
                    <h1 class="h1_def text-center mt-3"> {{__('web/developer.h1_compounds')}} {{$developer->name}} </h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8 ListProjectUnitsCard">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @if($projects->total() > 0)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if(!isset($_GET['property_page'])) active @endif() "
                                        id="pills-project-tab"
                                        data-bs-toggle="pill"
                                        data-bs-target="#pills-project"
                                        type="button"
                                        role="tab"
                                        aria-controls="pills-project"><span class="En_Font En_Font_number">{{$projects->total()}}</span>  {{__('web/developer.project') }}  </button>
                            </li>
                        @endif

                        @if($units->total() > 0 )
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if(isset($_GET['property_page'])) active @endif()"
                                        id="pills-units-tab"
                                        data-bs-toggle="pill"
                                        data-bs-target="#pills-units"
                                        type="button"
                                        role="tab"
                                        aria-controls="pills-units"><span class="En_Font En_Font_number">{{$units->total()}}</span> {{ __('web/developer.unit')}}</button>
                            </li>
                        @endif
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        @if($projects->total() > 0)
                            <div class="tab-pane fade @if(!isset($_GET['property_page'])) show active @endif() " id="pills-project" role="tabpanel" aria-labelledby="pills-project-tab">
                                <div class="row g-4 pb-5">
                                    @foreach($projects as $project)
                                        <div class="col-lg-6 mb-0">
                                            <x-site.project.card-photo  :project="$project" cardstyle="project_side_bar" />
                                        </div>
                                    @endforeach
                                </div>
                                <x-site.def.pagination :rows="$projects"/>
                            </div>
                        @endif



                        @if($units->total() > 0 )
                            <div class="tab-pane fade @if(isset($_GET['property_page'])) show active @endif() " id="pills-units" role="tabpanel" aria-labelledby="pills-units-tab">
                                <div class="row">
                                    @foreach($units as $unit)
                                        <x-site.unit.card-list :unit="$unit" removefrom="liveWire"  />
                                    @endforeach
                                </div>
                                <x-site.def.pagination :rows="$units"/>
                            </div>
                        @endif


                    </div>
                </div>
                <div class="col-lg-4 DeveloperSide StopViewX">
                    @if(count($posts) >0)
                        <h3 class="">{{ __('web/developer.h1_news') }} {{$developer->name}}</h3>
                        <hr>
                        @foreach($posts as $post)
                            <x-site.blog.right-side :post="$post" />
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 Des">
                    {!! $developer->des !!}
                </div>
            </div>
        </div>
    </div>
@endsection
