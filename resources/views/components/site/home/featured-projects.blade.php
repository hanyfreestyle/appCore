<section class="section-space--sm pt-lg-0 mt-lg-2">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-xl-12 Home_h2 text-center">
                <h2 class="mb-2">{{$title}}</h2>
            </div>
            <div class="col-xl-12 mb-5">
                <div class="list-group flex-row flex-wrap justify-content-xl-start gap-5  ">
                    <div class="Featured_Projects_Scroll">
                        @foreach($locations as $location)
                            <a href="#list-location_{{$location->id}}"
                               class="@if($loop->first) active @endif  featured-tab link clr-primary-400 d-inline-block py-3 px-2 bg-primary-50 :bg-primary-300 :clr-neutral-0 rounded-pill"
                               data-bs-toggle="list">
                                {{$location->name}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="nav-tabContent">
                    @foreach($locations as $location)
                        <div class="tab-pane fade @if($loop->first) show active @endif" id="list-location_{{$location->id}}">
                            <x-site.home.featured-projects-inc :locationid="$location->id"/>
                            <div class="text-center mt-10">
                                <a href="{{ LaravelLocalization::localizeUrl(route('page_locationView',$location->slug)) }}"
                                   class="btn btn-outline-primary py-3 px-6 rounded-pill d-inline-flex align-items-center gap-1 fw-semibold">
                                    {{__('web/def.view_all')}}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>
