<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  {!!htmlArDir()!!}  >
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
    {!! SEO::generate() !!}
    <x-site.def.fav-icon/>
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('css/bootstrap.min.css',$cssMinifyType,$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('css/style.css',$cssMinifyType,$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('fontawesome/all.css',$cssMinifyType,$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('css/style_footer.css',$cssMinifyType,$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('css/style_contact_us.css',$cssMinifyType,$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('share/share_buttons.css',$cssMinifyType,$cssReBuild) !!}
    @yield('AddStyle')
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('css/style_lang_'.thisCurrentLocale().'.css',$cssMinifyType,$cssReBuild) !!}
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

{!! (new \App\Helpers\MinifyTools)->MinifyJs('js/jquery-3.7.1.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('js/lazy/jquery.lazy.min.js',"SeoWeb",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('js/lazy/lazy_fun.js',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('js/customs.js',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('share/share-buttons.js',"Seo",$cssReBuild) !!}
<x-site.js.load-web-font/>
@livewireScripts
{{--<script>--}}
{{--    document.addEventListener('livewire:load', () => {--}}
{{--        Livewire.onPageExpired((response, message) => {})--}}
{{--    })--}}
{{--</script>--}}
@yield('AddScript')
@stack('ScriptCode')
{!! $printSchema->Businesses() !!}
</body>
</html>
