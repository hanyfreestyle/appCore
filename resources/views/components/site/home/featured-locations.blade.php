@if(count($locations) > 0)
    <section id="FeaturedLocations" class="section-space discover-location-section">
        <img src="{{ defWebAssets('img/category-section-el.png') }}" alt="image" class="img-fluid d-none d-xxl-block position-absolute category-section-element">
        <div class="section-space--sm-bottom">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xxl-6">
                        <div class="text-center Home_h2">
                            <h2 class="mt-4 mb-6"> {{__('web/home.title_featured_locations')}} </h2>
                            <p class="mb-0">{{__('web/home.title_featured_locations_text')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid p-md-0">
            <div class="row g-md-0">
                <div class="col-12">
                    <div class="location-slider-container">
                        <div class="swiper location-slider">
                            <div class="swiper-wrapper">
                                @foreach($locations as $location)
                                    <div class="swiper-slide">
                                        <div class="location-slider__card">
                                            <div class="location-slider__img location_slider_img">
                                                <x-site.def.img :row="$location" def="location" w="420" h="500" />
                                            </div>
                                            <div class="location-slider__content">

                                                <div class="d-flex align-items-center justify-content-between w-100">
                                                    <a href="{{ LaravelLocalization::localizeUrl(route('page_locationView',$location->slug)) }}" class="link d-flex flex-column gap-1 clr-neutral-0 flex-grow-1">
                                                        <span class="d-block location_card_name crop_line_1_span"> {{$location->name}} </span>
                                                        @if($location->projects_count > 0)
                                                            <span class="d-block location_card_project"><span class="En_Font">{{$location->projects_count}}</span>  {{__('web/def.project')}} </span>
                                                        @endif
                                                        @if($location->units_count > 0 )
                                                            <span class="d-block location_card_units"><span class="En_Font">{{$location->units_count}}</span> {{__('web/def.units')}} </span>
                                                        @endif
                                                    </a>

                                                </div>
                                                <a href="{{ LaravelLocalization::localizeUrl(route('page_locationView',$location->slug)) }}" class="location_card_icon link d-grid place-content-center w-9 h-9 border border-primary-50 rounded-circle clr-primary-50 :bg-primary-300 flex-shrink-0">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-pagination location-slider__pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
