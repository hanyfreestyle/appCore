<div>
    @if($listings->total() > 0)
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-5">
            <h2 class="mb-0 def_h2_out"> {{__('web/blog.h2_properties_for_sale')}} ({{$listings->total()}}) </h2>
        </div>

        @foreach($listings as $unit)
            <x-site.unit.card-list :unit="$unit" :lazy="false"  />
        @endforeach

        @if($listings->hasMorePages())
            <div class="row mb-5 ">
                <div class="col-12 text-center mb-lg-5">
                    <div wire:click="load" class="livewireReadMore btn btn-primary py-3 px-6 rounded-pill d-inline-flex align-items-center gap-1 fw-semibold">{{__('web/def.but_show_more')}}</div>
                </div>
            </div>
        @endif
    @endif
</div>

