<div class="bg-neutral-0 rounded-4 p-2 mb-10 SiteBoxShadow">
    <div class="blog_photo_div">
        <div href="#" class="link d-block rounded-4">
            <x-site.def.img :row="$post" name="photo" def-name="photo" def="blog" class="blog_img rounded-4" w="800" h="420" />
        </div>
    </div>
    <div class="p-5 pt-8">
        <h1 class="mb-0">{{$post->name}}</h1>
        <div class="hr-dashed my-4"></div>
        <div class="row blog_info" >

            <div class="col-lg-3 mb-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-calendar-days iconColor"></i>
                    <a href="#"  class="FS_16 crop_line_1"> {{$post->getFormatteDate()}} </a>
                </div>
            </div>

            @if($post->location_id != null)
                <div class="col-lg-4 mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-location-dot iconColor"></i>
                        <a class="FS_16 crop_line_1" href="{{route('page_locationView',$post->location->slug)}}">
                            {{$post->location->name}}
                        </a>
                    </div>
                </div>
            @endif

            @if($post->developer_id != null)
                <div class="col-lg-4 mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-person-digging iconColor"></i>
                        <a class="FS_16" href="{{route('page_developer_view',$post->developerName->slug)}}">
                            {{$post->developerName->name}}
                        </a>
                    </div>
                </div>
            @endif


            @if($project != null)
                <div class="col-lg-12">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-regular fa-building iconColor"></i>
                        <p class="mb-0 crop_line_1">
                            <a class="FS_16" href="{{route('page_ListView',$project->slug)}}">{{$project->name}}</a>
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
