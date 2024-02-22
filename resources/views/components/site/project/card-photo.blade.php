<div class="listing-card {{$cardstyle}}">
    <div class="listing-card__img img_div">
        <x-site.def.img :row="$project" def="project"  w="400" h="300" :lazy-active="$lazy"  />
    </div>

    <div class="listing-card__content">
        <div class="d-flex align-items-center justify-content-start">
            <span class="d-inline-block py-2 px-5 rounded-pill bg-tertiary-300 clr-neutral-900 FS_16"> {{ getProjectStatus($project->status) }} </span>
        </div>

        @if($WebConfig->fav_view)
            @if($removefrom == 'normal')
                <livewire:site.favorite-icon :listing="$project" />
            @elseif($removefrom == 'favPage')
                <form wire:submit.prevent="RemoveCard({{$project->id}})" method="post">
                    <button type="submit" class="property-card__fav w-10 h-10 rounded-circle bg-danger d-grid place-content-center border-0 clr-primary-300">
                        <i class="fa-solid fa-xmark card__heart_active"></i>
                    </button>
                </form>
            @endif
        @endif

        <div class="listing-card__content-is listing_card_content">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="project_type"> {{ getProjectTypeName($project->project_type)}} </span>
                @if(intval($project->price) > 0)
                    <div class="d-inline-block clr-tertiary-300 project_price">
                        <span class="FS_15 fw-normal clr-neutral-0">
                            {{ __('web/def.starting_from') }}
                        </span>
                        <span class="project_price_span En_Font">
                        {{ number_format($project->price) }}
                        </span>
                    </div>
                @endif
            </div>

            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <h4 class="project_name crop_line_2">
                    <a href="{{ LaravelLocalization::localizeUrl(route('page_ListView',$project->slug)) }}" class="link clr-neutral-0 :clr-neutral-0"> {{$project->name}} </a>
                </h4>
                <div class="d-flex">
                    <i class="fa-solid fa-location-dot clr-tertiary-300 card_fa_location"></i>
                    <a href="{{ LaravelLocalization::localizeUrl(route('page_locationView',$project->locationName->slug)) }}">
                        <span class="clr-neutral-0 project_locationName"> {{$project->locationName->name}} </span>
                    </a>
                </div>
                <div class="project_card_readmore">
                    <a href="{{ LaravelLocalization::localizeUrl(route('page_ListView',$project->slug)) }}" class="btn btn-outline-secondary rounded-pill py-3X px-6x">{{ __('web/def.units_read_more')}} </a>
                </div>
            </div>
        </div>
    </div>
</div>
{!! $printSchema->Project($project) !!}
