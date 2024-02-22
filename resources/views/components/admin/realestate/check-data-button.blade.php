<div class="row">
    <div class="col-lg-9 mb-2">
        <x-admin.form.action-button url="{{ route($PrefixRoute.'.noAr',$subid)  }}" :tip="false" size="s" print-lable="{{__('admin/page.checkdata_no_ar')}}" />
        <x-admin.form.action-button url="{{ route($PrefixRoute.'.noEn',$subid)  }}" :tip="false" size="s" print-lable="{{__('admin/page.checkdata_no_en')}}" />
        @if($photo)
            <x-admin.form.action-button url="{{ route($PrefixRoute.'.noPhoto',$subid)  }}" :tip="false" size="s" print-lable="{{__('admin/page.checkdata_no_photo')}}" />
        @endif

        @if($slug)
            <x-admin.form.action-button url="{{ route($PrefixRoute.'.slugErr',$subid)  }}" :tip="false" size="s" print-lable="{{__('admin/page.checkdata_slug_err')}}" />
        @endif
        <x-admin.form.action-button url="{{ route($PrefixRoute.'.unActive',$subid)  }}" :tip="false" size="s" print-lable="{{__('admin/page.checkdata_un_active')}}" />
    </div>
{{--    @if($viewDataTable == false)--}}
{{--        <div class="col-lg-3 mb-2">--}}
{{--            <x-admin.form.action-button url="#" :tip="false" size="s" bg="dark" print-lable="{{$row->total()}}" />--}}
{{--        </div>--}}
{{--    @else--}}
{{--        <div class="col-lg-3 mb-2">--}}
{{--            <x-admin.form.action-button url="#" :tip="false" size="s" bg="dark" print-lable="{{$row->count()}}" />--}}
{{--        </div>--}}
{{--    @endif--}}
</div>
