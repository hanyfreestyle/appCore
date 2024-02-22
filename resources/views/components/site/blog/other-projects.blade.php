@if(count($projects) > 0)
    <div class="section-space pt-xl-0 bg-primary-5p">
        <div class="container p-md-5">
            <div class="row g-md-0">
                <div class="col-12 mb-3 pb-3 text-center">
                    <h2 class="mb-0 h1_def">{{$titel}}</h2>
                </div>
                <div class="col-12">
                    <div class="project-other-project-container">
                        <div class="swiper project-other-project">
                            <div class="swiper-wrapper">
                                @foreach($projects as $project)
                                    <div class="swiper-slide ps-2">
                                        <x-site.project.card-photo  :project="$project" cardstyle="project_side_bar" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-pagination project-other-project__pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
