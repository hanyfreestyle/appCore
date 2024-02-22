@if(count($posts)>0)
    <div class="section-space bg-primary-5p">
        <div class="container">
            @if($titel)
                <div class="row">
                    <div class="col-12 Home_h2">
                        <h2 class="text-center pb-3">{{$titel}}</h2>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="NewsSliderDiv">
                        <div class="position-relative">
                            <div class="swiper blog_slider_style">
                                <div class="swiper-wrapper pb-5">
                                    @foreach($posts as $post)
                                        <div class="swiper-slide mb-5">
                                            <div class="property-card property-card--row SiteBoxShadow">
                                                <div class="property-card__head">
                                                    <a href="{{ LaravelLocalization::localizeUrl(route('page_blogView',[$post->getCatName->slug,$post->slug])) }}">
                                                        <div class="property-card__img NewsSliderImg">
                                                            <x-site.def.img :row="$post" def="blog" w="400" h="240" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="property-card__content">
                                                    <div class="property-card__body NewsSlider_text">
                                                        <h3 class="crop_line_2">
                                                            <a href="{{ LaravelLocalization::localizeUrl(route('page_blogView',[$post->getCatName->slug,$post->slug])) }}">
                                                                {{$post->name}}
                                                            </a>
                                                        </h3>
                                                        <p class="mb-3 crop_line_2"> {!! \App\Helpers\AdminHelper::seoDesClean($post->des) !!}</p>
                                                    </div>
                                                    <div class="hr-dashed"></div>
                                                    <div class="property-card__body NewsSlider_but">
                                                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                            <span class="d-inline-block">  {{$post->getFormatteDate()}} </span>
                                                            <a class="btn btn-outline-primary py-3 px-4 rounded-pill d-inline-flex " href="{{ LaravelLocalization::localizeUrl(route('page_blogView',[$post->getCatName->slug,$post->slug])) }}" > {{__('web/def.units_read_more')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {!! $printSchema->Article($post,'page_blogView') !!}
                                    @endforeach
                                </div>
                            </div>
                            <div class="swiper-pagination blog_slider_style__pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
