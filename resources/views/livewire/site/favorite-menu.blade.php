<div>
   <a href="{{ LaravelLocalization::localizeUrl(route('FavoriteListing'))}}" class="link d-flex align-items-center gap-2 p-2 rounded-pill bg-primary-5p clr-neutral-500">
        <i class="fa-solid fa-heart favorite_icon  @if($facCount > 0) fav_icon_red @endif"></i>
    </a>
</div>
