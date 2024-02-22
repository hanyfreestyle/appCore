@if($vcode)
    <div class="p-6 bg-neutral-0 rounded-4 mb-10">
        @if($title)
            <h2 class="def_h2_blocks">{{$title}}</h2>
        @endif

        <div id="youtube_div"  class="property-showcase bg-neutral-0 p-1 rounded-4 overflow-hidden position-relative z-1">
            <img src="{{getDefPhotoPath($DefPhotoList,'video_photo')}}" alt="image" class="img-fluid w-100 rounded-4 z-n1">
            <span  class="youtube_play_but link d-grid place-content-center w-14 h-14 rounded-circle bg-tertiary-300 clr-neutral-900 z-2 position-absolute position-center">
                                <span class="material-symbols-rounded mat-icon solid fs-36"> play_arrow </span>
                            </span>
        </div>

        <div id="youtube_ifram" class="mt-3" style="display:none;" >
            <div class="embed-responsive embed-responsive-16by9 mb-4">
                <iframe  src="https://www.youtube.com/embed/{{$vcode}}?autoplay=0" class="lazyload"  frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endif
