@if($projects != null and $projects->web_units_count > 0 )

    <livewire:load-more-units type="Unit" :project-id="$projects->id" :unit-id="0" />

{{--    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-5">--}}
{{--        <h2 class="mb-0 def_h2_out"> {{__('web/blog.h2-properties-for-sale')}} ({{$projects->web_units_count}}) </h2>--}}
{{--    </div>--}}

{{--    @foreach($projects->web_units as $unit)--}}
{{--        <x-site.unit.card-list  :unit="$unit"  />--}}
{{--    @endforeach--}}

{{--    <div class="row mb-5 ">--}}
{{--        <div class="col-12 text-center mb-lg-5">--}}
{{--            <div class="show-more-units btn btn-primary py-3 px-6 rounded-pill d-inline-flex align-items-center gap-1 fw-semibold">{{__('web/def.but-show-more')}}</div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endif
