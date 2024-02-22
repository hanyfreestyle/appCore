@extends('web.layouts.app')
@section('content')

    <x-site.def.breadcrumbs>
        {{ Breadcrumbs::render('post_view',$category,$post) }}
    </x-site.def.breadcrumbs>

    <div class="FixedBreadcrumbLine BlogView bg-primary-5p ">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">

                    <x-site.blog.blog-body :post="$post"  :project="$project_tag"/>

                    @if($project_tag != null)
                        <livewire:load-more-units type="Project" :project-id="$project_tag->id" />
                    @endif

                    <x-site.def.description :row="$post" title="{{__('web/blog.h2_description')}}"/>

                    @if($project_tag != null)
                        @if($project_tag->youtube_url)
                            <livewire:site.youtube :vcode="$project_tag->youtube_url" title="{{__('web/blog.h2_video')}}"/>
                            {!! $printSchema->Video($project_tag) !!}
                        @endif

                        @if($project_tag->amenity)
                            <x-site.def.amenities :senddata="$project_tag->amenity" title="{{__('web/blog.h2_amenities')}}" />
                        @endif
                    @endif

                </div>

                <div class="col-lg-4">
                    <x-site.blog.related-projects :related-projects="$relatedProjects" />
                </div>

            </div>
        </div>
    </div>

    <x-site.blog.related-slider :posts="$relatedPosts" titel="{{__('web/blog.related_news')}}" />

    <x-site.blog.other-projects :projects="$other_project" titel="{{__('web/blog.other_projects')}}" />

    {!! $printSchema->Article($post,'page_blogView') !!}
@endsection
