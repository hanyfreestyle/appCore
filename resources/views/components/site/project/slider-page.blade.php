<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-12">
            <div class="swiper property-gallery-slider">
                <div class="swiper-wrapper property-gallery-slider">
                    @if($type == 'new_slider')
                        @foreach($photos as $photo)
                            <div class="swiper-slide Pro_Slider_New">
                                <a href="{{getPhotoPath($photo->photo,"blog")}}" class="link property-gallery">
                                    <img src="{{getPhotoPath($photo->photo_thum_1,"project")}}"
                                         alt="{{$unit->name}}" title="{{$unit->name}}" class="lazy img-fluid">
                                </a>
                            </div>
                        @endforeach
                    @elseif($type == 'old_slider')
                        @foreach($photos as $photo)
                            <div class="swiper-slide Pro_Slider_Old">
                                <a href="{{ url("ckfinder/userfiles/".$unit->slider_images_dir."/".pathinfo($photo, PATHINFO_BASENAME)) }}" class="link property-gallery">
                                    <img src="{{ url("ckfinder/userfiles/".$unit->slider_images_dir."/".pathinfo($photo, PATHINFO_BASENAME)) }}"
                                         alt="{{$unit->name}}" title="{{$unit->name}}" class="lazy img-fluid">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="swiper-button-prev property-gallery-slider__btn property-gallery-slider__btn-prev">
                </div>
                <div class="swiper-button-next property-gallery-slider__btn property-gallery-slider__btn-next">
                </div>
            </div>
        </div>
    </div>
</div>
