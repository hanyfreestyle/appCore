<div class="row g-4">
    @if(isset($projects[0]))
        <div class="col-md-6 col-xl-4">
            <x-site.project.card-photo  :project="$projects[0]" cardstyle="project_side_bar_home" />
        </div>
    @endif
    <div class="col-xl-4 order-md-3 order-xl-2">
        <div class="row g-4">
            @if(isset($projects[1]))
                <div class="col-md-6 col-xl-12">
                    <x-site.project.card-photo  :project="$projects[1]" cardstyle="project_side_bar" />
                </div>
            @endif
            @if(isset($projects[2]))
                <div class="col-md-6 col-xl-12">
                    <x-site.project.card-photo  :project="$projects[2]" cardstyle="project_side_bar" />
                </div>
            @endif
        </div>
    </div>
    @if(isset($projects[3]))
        <div class="col-md-6 col-xl-4 order-xl-3">
            <x-site.project.card-photo  :project="$projects[3]" cardstyle="project_side_bar_home" />
        </div>
    @endif
</div>
