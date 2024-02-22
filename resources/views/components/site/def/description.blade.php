<div class="p-6 bg-neutral-0 rounded-4 mb-10 SiteBoxShadow">
    @if($title)
        <h2 class="def_h2_blocks">{{$title}}</h2>
    @endif
    <div id="wrapped_text" class="description-content">
        {!! $row->des !!}
        <br>
        {{$slot}}
    </div>
    <div class="ButDivCon">
        <div class="show_text_but ">
            <div class="btn btn-outline-primary py-3 px-6 rounded-pill d-inline-flex align-items-center gap-1 fw-semibold">
                {{__('web/def.but_show_more')}}
            </div>
        </div>

        <div class="hide_text_but">
            <div class="btn btn-outline-primary py-3 px-6 rounded-pill d-inline-flex align-items-center gap-1 fw-semibold">
                {{__('web/def.but_show_less')}}
            </div>
        </div>
    </div>
</div>
