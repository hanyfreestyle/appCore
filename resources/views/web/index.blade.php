@extends('web.layouts.app')
@section('content')

    @include('web.layouts.inc.home_slider')

    <x-site.home.featured-locations/>

    <x-site.home.featured-projects/>

    <x-site.home.featured-developers/>

    <x-site.blog.related-slider  :posts="$relatedPosts" titel="{{__('web/home.title_latest_real_estate_updates')}}" />

@endsection
