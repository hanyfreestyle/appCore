<div class="col-12 mb-5">
    <div class="property-card property-card--row SiteBoxShadow">
        <div class="property-card__head">
            <div class="swiper-slide ">
                <div class="property-card__img unit_card_img">
                    <x-site.def.img :row="$unit" def="units" class="blog_img rounded-4" w="400" h="300" :lazy-active="$lazy" />
                </div>
            </div>

            <a href="#" class="property_type_name link property-card__tag d-inline-block bg-neutral-0 :bg-primary-300 clr-primary-300 :clr-neutral-0 py-2 px-4 rounded-pill">
                {{ getPropertyTypeName($unit->property_type) }}
            </a>
            @if($WebConfig->fav_view)
                @if($removefrom == 'normal')
                    @if($cart->where('id', $unit->id)->count() == '0')
                        <form wire:submit.prevent="addToCart({{$unit->id}})" method="post">
                            <button wire:loading.remove type="submit" class="property-card__fav w-10 h-10 rounded-circle bg-neutral-0 d-grid place-content-center border-0 clr-primary-300">
                                <i class="fa-solid fa-heart card__heart_unactive"></i>
                            </button>
                        </form>
                    @else
                        <form wire:submit.prevent="removeFromCart({{$unit->id}})" method="post">
                            <button wire:loading.remove type="submit" class="property-card__fav w-10 h-10 rounded-circle bg-danger d-grid place-content-center border-0 clr-primary-300">
                                <i class="fa-solid fa-heart card__heart_active"></i>
                            </button>
                        </form>
                    @endif
                @elseif($removefrom == 'favPage')
                    <form wire:submit.prevent="RemoveCard({{$unit->id}})" method="post">
                        <button type="submit" class="property-card__fav w-10 h-10 rounded-circle bg-danger d-grid place-content-center border-0 clr-primary-300">
                            <i class="fa-solid fa-xmark card__heart_active"></i>
                        </button>
                    </form>
                @elseif($removefrom == 'liveWire')
                    <livewire:site.favorite-icon :listing="$unit" />
                @endif
            @endif
        </div>

        <div class="property-card__content">
            <div class="property-card__body  property_card__body_new">
                <div class="d-flex align-items-center gap-1">
                    <i class="fa-solid fa-location-dot clr-tertiary-400"></i>
                    <span class="d-inline-block distance_name">
                        <a class="" href="{{route('page_locationView',$unit->locationName->slug)}}">{{$unit->locationName->name}}</a>
                    </span>
                </div>

                <a href="{{route('page_ListView',$unit->slug)}}" class="link d-block clr-neutral-700 :clr-primary-300 fs-20 fw-medium mb-3">
                    <h3 class="crop_line_2 ">{{$unit->name}}</h3>
                </a>

                <ul class="units_li">
                    @if(intval($unit->rooms) != 0)
                        <li>
                            <i class="fa-solid fa-person-shelter units_li_icon"></i>
                            <span class="d-block units_li_text "> <span class="En_Font">{{$unit->rooms}}</span> {{__('web/def.units_room')}}</span>
                        </li>
                    @endif

                    @if(intval($unit->baths) != 0)
                        <li>
                            <i class="fa-solid fa-bath units_li_icon"></i>
                            <span class="d-block  units_li_text"> <span class="En_Font">{{$unit->baths}}</span> {{__('web/def.units_bath')}}</span>
                        </li>
                    @endif

                    @if(intval($unit->area) != 0)
                        <li>
                            <i class="fa-solid fa-up-right-and-down-left-from-center units_li_icon"></i>
                            <div class="d-block  units_li_text"><span class="En_Font">{{$unit->area}}</span> {{__('web/def.units_area')}}</div>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="hr-dashed"></div>
            <div class="property-card__body property_call_to_action">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <ul class="list list-row flex-wrap gap-3 justify-content-center">
                        <x-site.contact.call-to-action-button :unit="$unit" view-type="UnitCard"  :config="$WebConfig" />
                    </ul>
                    <a href="{{route('page_ListView',$unit->slug)}}" class="btn btn-outline-primary py-3 px-6 rounded-pill d-inline-flex align-items-center gap-1 fw-semibold">
                        {{__('web/def.units_read_more')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
{!! $printSchema->Units($unit) !!}
