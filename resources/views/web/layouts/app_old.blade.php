<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  {!!htmlArDir()!!}  >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    <x-site.def.fav-icon/>
    <link rel="stylesheet" href="{{ defWebAssets('css/fonts/material-icon.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('fonts/fontawesome_all.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/fonts/ff-1.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style.css') }}">


    <link rel="stylesheet" href="{{ defWebAssets('css/home_page.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style_footer_4.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style_default.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style_header.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style_blog.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style_project_card.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style_developers.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style_compounds.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style_listing_view.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style_pages_view.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/contact_us.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/style_fav.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('share/share-buttons.css') }}">
    @yield('AddStyle')
    <link rel="stylesheet" href="{{ defWebAssets('css/style_edit_'.thisCurrentLocale().'.css') }}">
    @livewireStyles

</head>
<body>

@if($_SERVER['HTTP_HOST'] != 'localhost' )
    @include('web.layouts.inc.preloader')
@endif
@if(isset($DefPhotoList))
    @include('web.layouts.inc.header_top')
    @include('web.layouts.inc.header_menu')
@endif

@yield('content')

@if(isset($DefPhotoList))
    @include('web.layouts.inc.footer')
@endif


<script src="{{ defWebAssets('js/jquery-3.7.1.js') }}" ></script>
<script type="text/javascript" src="{{ defWebAssets('js/lazy/jquery.lazy.min.js') }}"></script>
<script>
    $(function() {
        $('.lazy').lazy();
    });

    $(document).ready(function() {
        $('.swiper-pagination-bullet').click(function() {
            $('.lazy').lazy({
                bind: "event",
                delay: 0
            });
        });
    });
    $(document).ready(function() {
        $('.swiper-button-next').click(function() {
            $('.lazy').lazy({
                bind: "event",
                delay: 0
            });
        });
    });
    $(document).ready(function() {
        $('.swiper-button-prev').click(function() {
            $('.lazy').lazy({
                bind: "event",
                delay: 0
            });
        });
    });
</script>


<script src="{{ defWebAssets('js/leaflet.js') }}"></script>
<script src="{{ defWebAssets('js/plugins.js') }}"></script>
<script src="{{ defWebAssets('js/app.js') }}"></script>
<script src="{{ defWebAssets('js/app_sliders.js') }}"></script>
<script src="{{ defWebAssets('js/app_script.js') }}"></script>
<script src="{{ defWebAssets('share/share-buttons.js') }}"></script>


<script>
    async function loadarfont(){
        const font_ar = new FontFace('Aljazeera','url({{ defWebAssets('fonts/Ar/Aljazeera.woff') }}');
        await font_ar.load();
        document.fonts.add(font_ar);
        document.body.classList.add('Aljazeera');
    };
    loadarfont();

    async function loadarfont_en(){
        const font_en = new FontFace('Poppins','url({{ defWebAssets('fonts/En/Poppins-Regular.woff2') }}');
        await font_en.load();
        document.fonts.add(font_en);
        document.body.classList.add('Poppins');
    };
    loadarfont_en();
</script>
<x-site.js.show-more-show-less/>

@livewireScripts
{{--<script>--}}
{{--    document.addEventListener('livewire:load', () => {--}}
{{--        Livewire.onPageExpired((response, message) => {})--}}
{{--    })--}}
{{--</script>--}}

<script>
    // --- Nav |  01  |  Side-Slide
    $('.btn01').click(function() {
        $('.side-slide').animate({left: "0px"}, 200);
    });

    $('h3.nav01').click(function() {
        $('.side-slide').animate({left: "-100%"}, 200);
    });
</script>

@yield('AddScript')
@stack('ScriptCode')
</body>
</html>
