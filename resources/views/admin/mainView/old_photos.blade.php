@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.confirm-massage/>
    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-7">
                <h1 class="def_h1_new">{!! print_h1($Project) !!}</h1>
            </div>
            <div class="col-5 dir_button">

                @if($Project->listing_type == 'Project')
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.faq_list',$Project->id)}}" print-lable="FAQ" icon="fas fa-question" :tip="false" bg="dark" />
                @endif
                @if($Project->listing_type == 'Project' or $Project->listing_type == 'ForSale' )
                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.More_Photos', $Project->id)}}" type="morePhoto" :tip="false" />
                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.edit', $Project->id)}}" type="back" />
                @endif

                @if($Project->listing_type == 'Unit')
                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.More_Photos', [$Project->parent_id,$Project->id])}}" type="morePhoto" :tip="false" />
                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.edit', [$Project->parent_id,$Project->id])}}" type="back" />
                @endif

            </div>
        </div>
   </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.normal title="{{__('admin/form.button_old_photo')}}">
            <div class="row">
                @if(count($ProjectPhotos)>0)
                    <div class="row col-lg-12 hanySort">
                        @foreach($ProjectPhotos as $Photo)
                            <div class="col-lg-2 ListThisItam">
                                <p class="PhotoImageCard">
                                    <img src=" {{ url("ckfinder/userfiles/".$Project->slider_images_dir."/".pathinfo($Photo, PATHINFO_BASENAME)) }}">
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="col-lg-12">
                        <x-admin.hmtl.alert-massage type="nodata" />
                    </div>
                @endif
            </div>
        </x-admin.card.normal>

   </x-admin.hmtl.section>
@endsection
