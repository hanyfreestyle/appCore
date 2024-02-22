<div>
    <div class="row">
        <div class="col-lg-12">
            @if(count($listings) == 0)
                <div class="text-center ThanksPage">
                    <h1 class="mt-4 mb-2 h1_def ">{{__('web/favorite.nodata_h1')}}</h1>
                    <p class="mb-5 p_def">{!! nl2br(__('web/favorite.nodata_text')) !!} </p>
                    <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="no_data" def-name="photo" alt="nodata" class="img-fluid" :lazy-active="false"  />
                </div>
            @else
                @if(isset($listings['Project']) and count($listings['Project']) > 0 )
                    <div class="col-md-12"><h2 class="h1_def h1_def_en">{{ __('web/favorite.h2_compound') }}</h2></div>
                    <div class="row g-4 pb-5">
                        @foreach($listings['Project'] as $project)
                            <div class="col-lg-6 mb-0">
                                <x-site.project.card-photo  :project="$project" cardstyle="project_side_bar" removefrom="favPage" :lazy="false" />
                            </div>
                        @endforeach
                    </div>
                @endif

                @if( (isset($listings['Unit']) and count($listings['Unit']) > 0) or (isset($listings['ForSale']) and count($listings['ForSale']) > 0)  )
                    <div class="col-md-12"><h2 class="h1_def h1_def_en">{{ __('web/favorite.h2_units') }}</h2></div>
                @endif

                @if(isset($listings['Unit']) and count($listings['Unit']) > 0 )
                    @foreach($listings['Unit'] as $unit)
                        <x-site.unit.card-list :unit="$unit" removefrom="favPage" :lazy="false"  />
                    @endforeach
                @endif

                @if(isset($listings['ForSale']) and count($listings['ForSale']) > 0 )
                    @foreach($listings['ForSale'] as $unit)
                        <x-site.unit.card-list :unit="$unit" removefrom="favPage" :lazy="false"  />
                    @endforeach
                @endif

            @endif
        </div>
    </div>
</div>
