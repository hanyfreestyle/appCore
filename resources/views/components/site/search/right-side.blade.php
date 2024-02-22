<div class="py-3 px-8 bg-neutral-0 rounded-4 SiteBoxShadow rightSearchBox">
    <h4 class="mb-0"> {{__('web/search.h1')}} </h4>
    <div class="hr-dashed opacity-50"></div>

    <form action="{{$route}}" method="GET">
        <div class="row">
            <div class="col-lg-12">
                <x-site.search.select name="location" :send-arr="$locations" print-val="slug" label="{{__('web/search.t_location')}}" />
                @if($project)
                    <x-site.search.select name="project_type" :send-arr="$ProjectType_Arr" label="{{__('web/search.t_project_type')}}" />
                @endif
                <x-site.search.select name="property_type" :send-arr="$Property_TypeArr"  label="{{__('web/search.t_property_type')}}" />
                @if($developer)
                    <x-site.search.select name="developer" :send-arr="$DeveloperArr" print-val="slug" label="{{__('web/search.t_developer')}}" />
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <x-site.search.select name="rooms" :send-arr="$Bedrooms_Arr" print-val="id" label="{{__('web/search.t_bed_rooms')}}" />
            </div>

            <div class="col-lg-6">
                <x-site.search.select name="baths" :send-arr="$Bedrooms_Arr" print-val="id" label="{{__('web/search.t_bath_rooms')}}" />
            </div>
        </div>


        <div class="row">
            <label>{{__('web/search.t_area')}}</label>
            <div class="col-lg-6 col-6">
                <x-site.search.select name="min_area" :send-arr="$Area_Arr" print-val="id" :labelview="false" def-select="{{__('web/search.view_min')}}" />
            </div>

            <div class="col-lg-6 col-6">
                <x-site.search.select name="max_area" :send-arr="$Area_Arr" print-val="id" :labelview="false"  def-select="{{__('web/search.view_max')}}" />
            </div>
        </div>


        <div class="row">
            <label>{{__('web/search.t_price')}}</label>
            <div class="col-lg-6 col-6">
                <x-site.search.select name="min_price" :send-arr="$Price_Arr" print-val="id" :labelview="false" def-select="{{__('web/search.view_min')}}" />
            </div>

            <div class="col-lg-6 col-6">
                <x-site.search.select name="max_price" :send-arr="$Price_Arr" print-val="id" :labelview="false"  def-select="{{__('web/search.view_max')}}" />
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <button type="submit" class="btn btn_serach  rounded-pill property-search__btn property-search__col">
                    <i class="fas fa-search"></i>  {{__('web/search.but_search')}}
                </button>
            </div>
        </div>

    </form>
</div>

