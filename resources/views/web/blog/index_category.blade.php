@extends('web.layouts.app')
@section('content')
    <x-site.def.breadcrumbs>
        {{ Breadcrumbs::render('blogCatList',$category) }}
    </x-site.def.breadcrumbs>

    <div class="FixedBreadcrumbLine BlogList bg-primary-5p">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-12">
                    <h1 class="h1_def">{!! $category->name !!}</h1>
                    <div class="row blogas_row">
                        @foreach($posts as $post)
                            <div class="col-lg-4 mb-5">
                                <x-site.blog.card-list :post="$post"/>
                            </div>
                        @endforeach
                    </div>
                    <x-site.def.pagination :rows="$posts" />
                </div>
            </div>
        </div>
        <hr>
        <x-site.blog.category-list />
    </div>
@endsection
