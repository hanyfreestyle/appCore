<div class="p-6 bg-neutral-0 rounded-4 border border-neutral-40 mb-10 ProjectViewInfo">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="py-2 px-5 bg-primary-50 rounded-pill pro_type">
            <span class="clr-primary-300 d-inline-block mb-0 "> {{ getPropertyTypeName($row->property_type) }} </span>
        </div>
        <ul class="list list-row gap-3 align-items-center ListingViewInfo_Social">
            @if($WebConfig->fav_view)
                <livewire:site.favorite-icon :listing="$row" fromwhere="ListView" />
            @endif
            <x-site.def.share-button :row="$row" />
        </ul>
    </div>

    <h1 class="mt-4 mb-5">
        {{$row->name}}
    </h1>

    <div class="row mt-5">
        @if(intval($row->price)>0)
            <div class="col-lg-4 mb-5">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-money-check-alt iconColor"></i>
                    <p class="mb-0 pro_info">
                        {{ __('web/def.start_from') }} <span class="start_from En_Font"> {{number_format($row->price)}} </span>
                    </p>
                </div>
            </div>
        @endif

        <div class="col-lg-4 mb-4">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-map-marker-alt iconColor"></i>
                <p class="mb-0 crop_line_1 pro_info">
                    <a href="{{route('page_locationView',$row->locationName->slug)}}">
                        {{$row->locationName->name}}
                    </a>
                </p>
            </div>
        </div>

        @if(intval($row->developer_id) != null)
            <div class="col-lg-4 mb-5">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-person-digging iconColor"></i>
                    <p class="mb-0 crop_line_1 pro_info">
                        <a class="" href="{{route('page_developer_view',$row->developerName->slug)}}">
                            {{$row->developerName->name}}
                        </a>
                    </p>
                </div>
            </div>
        @endif

    </div>
    <div class="hr-dashed"></div>

    <div class="row mt-5" >
        @if(intval($row->rooms) != 0)
            <div class="col-lg-2 mb-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-person-shelter iconColor"></i>

                    <p class="mb-0 pro_info">
                        {{$row->rooms}} {{__('web/def.units_room')}}
                    </p>
                </div>
            </div>
        @endif

        @if(intval($row->baths) != 0)
            <div class="col-lg-2 mb-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-bath iconColor"></i>
                    <p class="mb-0 crop_line_1 pro_info">
                        {{$row->baths}} {{__('web/def.units_bath')}}
                    </p>
                </div>
            </div>
        @endif

        @if(intval($row->area) != 0)
            <div class="col-lg-2 mb-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-up-right-and-down-left-from-center iconColor"></i>

                    <p class="mb-0 crop_line_1 pro_info">
                        {{$row->area}} {{__('web/def.units_area')}} <sup>2</sup>
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>
