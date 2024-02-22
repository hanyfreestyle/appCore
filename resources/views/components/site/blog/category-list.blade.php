<div class="container">
    <div class="row blog_category_list">
        @foreach($categories as $category)
            @if($category->posts_count > 0)
                <div class="col-lg-3 mb-2">
                    <a href="{{route('page_blogCatList',$category->slug)}}">{{ $category->name }}  ({{  $category->posts_count}}) </a>
                </div>
            @endif
        @endforeach
    </div>
</div>
