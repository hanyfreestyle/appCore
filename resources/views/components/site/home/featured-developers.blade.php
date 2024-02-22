<div class="section-space--sm pt-lg-0 mt-lg-0 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <div class="text-center Home_h2">
                    <h2 class="mb-5 pb-5 "> {{ $title }} </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="position-relative">
                    <div class="swiper team-slider">
                        <div class="swiper-wrapper">
                            @foreach($developers as $developer)
                                <div class="swiper-slide">
                                    <div class="dev_slider_card text-center">
                                        <div class="developer_img_div">
                                            <a href="{{ LaravelLocalization::localizeUrl(route('page_developer_view',$developer->slug)) }}">
                                                <x-site.def.img :row="$developer" def="developer" class="developer_list_img" w="300" h="300" />
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="mb-2 home_developer_name crop_line_1">
                                        <a href="{{ LaravelLocalization::localizeUrl(route('page_developer_view',$developer->slug)) }}">{{$developer->name}}</a>
                                    </h4>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-pagination team-slider__pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>
