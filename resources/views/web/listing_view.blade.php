@extends('web.layouts.app')

@section('content')

    @if($unit->listing_type == 'Project' or $unit->listing_type == 'ForSale' )
        @if($unit->slider_count > 2)
            <x-site.project.slider-page :unit="$unit" :photos="$unit->slider" type="new_slider"  />
        @elseif(count($old_slider) > 2 )
            <x-site.project.slider-page :unit="$unit" :photos="$old_slider" type="old_slider"  />
        @endif

    @elseif($unit->listing_type == 'Unit')
        @if($unit->slider_count > 2)
            <x-site.project.slider-page :unit="$unit" :photos="$unit->slider" type="new_slider"  />
        @elseif($unit->projectName->slider_count > 2)
            <x-site.project.slider-page :unit="$unit" :photos="$unit->project->slider" type="new_slider"  />
        @elseif(count($old_slider) > 2 )
            <x-site.project.slider-page :unit="$unit" :photos="$old_slider" type="old_slider"  />
        @endif
    @endif

    <div class="bg-primary-5p">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="section-space--sm">

                        @if($unit->listing_type == 'Project')
                            <x-site.project.info-card :row="$unit"/>
                        @elseif($unit->listing_type != 'Project' )
                            <x-site.unit.info-card :row="$unit" />
                        @endif
                        <div class="requestOnPage mb-5">
                            <x-site.contact.form-on-page :row="$unit" form-id="header" defroute="ContactSaveFormOnPage"/>
                        </div>

                        @if($unit->listing_type == 'Project')
                            <livewire:load-more-units type="Project" :project-id="$unit->id" />
                        @elseif($unit->listing_type == 'Unit')
                            <livewire:load-more-units type="Unit" :project-id="$unit->parent_id" :unit-id="$unit->id" />
                        @endif

                        <x-site.def.description  :row="$unit" title="{{$description}}">
                            <x-site.def.breadcrumbs>
                                {{ Breadcrumbs::render('ProjectView',$trees,$unit) }}
                            </x-site.def.breadcrumbs>
                        </x-site.def.description>

                        <x-site.def.amenities :senddata="$amenities" title="{{__('web/blog.h2_amenities')}}" />

                        <livewire:site.youtube :vcode="$youtube" title="{{__('web/blog.h2_video')}}"/>

                        <livewire:site.google-map :row="$unit" title="{{ __('web/compound.listview_h2_map') }}"/>

                        <x-site.def.project-faq :row="$unit"  title="{{__('web/compound.listview_h2_faq')}}"/>

                        <div class="requestOnPage mb-5">
                            <x-site.contact.form-on-page :row="$unit" form-id="footer" defroute="ContactSaveFormOnPage" />
                        </div>

                    </div>

                </div>
                <div class="col-xl-4">
                    <div class="section-space--sm">
                        <x-site.search.right-side />
                    </div>
                </div>
            </div>
        </div>
    </div>

@if($unit->listing_type == 'Project')
    {!! $printSchema->Project($unit) !!}
@else
    {!! $printSchema->Units($unit) !!}
@endif


@endsection



