@if($relatedProjects != null)
    @if(count($relatedProjects)> 0)
        <h4 class="def_sidebar_h crop_line_1">{{__('web/blog.best_compounds_in')}} {{$relatedProjects->first()->locationName->name}}</h4>
        <div class="row g-4 sidebar_div">
            @foreach($relatedProjects as $project)
                <x-site.project.card-photo  :project="$project" cardstyle="project_side_bar" />
            @endforeach
        </div>
    @endif
@endif

