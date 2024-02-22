<div class="primary-hero">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-8 home_slider_text">
                <h1 class="d2 text-center mb-6"> {{__('web/home.slider_h1')}} </h1>
                <p class="max-text-40 mx-auto text-center fs-20 mb-10"> {{__('web/home.slider_p')}}</p>
            </div>
            <div class="col-xxl-10">
                <form action="{{route('Search')}}" method="get" >
                    <div class="property-search p-6 rounded-3 bg-neutral-0 SiteBoxShadowX">
                        <div class="property-search__content d-flex flex-wrap justify-content-center align-items-center gap-4 home_search">

                            <div class="property-search__select property-search__col rounded-pill d-flex align-items-center gap-2 px-6">
                                <i class="fa-solid fa-location-dot"></i>
                                <select name="location" class="form-selects homeSelect" aria-label="Default select example">
                                    <option value="">{{__('web/home.slider_fr_location')}}</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->slug}}" @if($location->slug == issetArr($_GET,"location") ) selected @endif   >{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="property-search__select property-search__col rounded-pill d-flex align-items-center gap-2 px-6">
                                <i class="fa-solid fa-building"></i>
                                <select name="project_type" class="form-selects homeSelect" aria-label="Default select example">
                                    <option value="">{{__('web/home.slider_fr_project_type')}}</option>
                                    @foreach($ProjectType_Arr as $project_type)
                                        <option value="{{$project_type['id']}}" @if($project_type['id'] == issetArr($_GET,"project_type") ) selected @endif  >{{ getProjectTypeName($project_type['id']) }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="property-search__select property-search__col rounded-pill d-flex align-items-center gap-2 px-6">
                                <i class="fa-solid fa-person-shelter"></i>
                                <select name="property_type" class="form-selects homeSelect" aria-label="Default select example">
                                    <option value="">{{__('web/home.slider_fr_property_type')}}</option>
                                    @foreach($Property_TypeArr as $property_type)
                                        <option value="{{$property_type['id']}}" @if($property_type['id'] == issetArr($_GET,"property_type") ) selected @endif  >{{getPropertyTypeName($property_type['id'])}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="property-search__select property-search__col rounded-pill d-flex align-items-center gap-2 px-6">
                                <i class="fa-solid fa-person-digging"></i>
                                <select name="developer" class="form-selects homeSelect" aria-label="Default select example">
                                    <option value="">{{__('web/search.t_developer')}}</option>
                                    @foreach($DeveloperArr as $developer)
                                        <option value="{{$developer->slug}}" @if($developer->slug == issetArr($_GET,"developer") ) selected @endif  >{{$developer->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn rounded-pill property-search__btn property-search__col clrw">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <img src="{{ defWebAssets('img/primary-hero-img-1.webp') }}" alt="image" class="img-fluid primary-hero__el primary-hero__img-1">
    <img src="{{ defWebAssets('img/primary-hero-img-2.webp') }}" alt="image" class="img-fluid primary-hero__el primary-hero__img-2">
    <img src="{{ defWebAssets('img/primary-hero-el-3.png') }}" alt="image" class="img-fluid primary-hero__el primary-hero__el-3">
    <img src="{{ defWebAssets('img/primary-hero-el-4.png') }}" alt="image" class="img-fluid primary-hero__el primary-hero__el-4">
    <img src="{{ defWebAssets('img/primary-hero-el-5.png') }}" alt="image" class="img-fluid primary-hero__el primary-hero__el-5">
    <img src="{{ defWebAssets('img/primary-hero-el-6.png') }}" alt="image" class="img-fluid primary-hero__el primary-hero__el-6">
    <img src="{{ defWebAssets('img/primary-hero-el-7.png') }}" alt="image" class="img-fluid primary-hero__el primary-hero__el-7">
    <img src="{{ defWebAssets('img/primary-hero-el-8.png') }}" alt="image" class="img-fluid primary-hero__el primary-hero__el-8">
{{--        <div class="scroll-nav text-center">--}}
{{--            <div class="w-15 h-15 d-grid place-content-center bg-primary-300 clr-neutral-0 rounded-circle">--}}
{{--                <i class="fa-solid fa-arrow-down"></i>--}}
{{--            </div>--}}
{{--            <div class="d-inline-block text-center fs-14 mt-3 FeaturedLocationsHome"><a href="#FeaturedLocations">{{__('web/home.slider_fr_more_details')}}</a> </div>--}}
{{--        </div>--}}

</div>


@section('AddScript')

@endsection
