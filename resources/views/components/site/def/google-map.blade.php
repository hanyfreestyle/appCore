@if($lat != null and $long != null)
    <div class="p-6 bg-neutral-0 rounded-4 mb-10">
        @if($title)
            <h2 class="def_h2_blocks">{{$title}}</h2>
        @endif
        <div class="w-100">
{{--            <iframe class="w-100 h-400 rounded-4" src="https://maps.google.com/maps?q={{$lat}},{{$long}}&z=17&amp;output=embed"></iframe>--}}
        </div>
    </div>
@endif
