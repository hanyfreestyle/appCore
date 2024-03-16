<x-admin.hmtl.section>
    @if($pageData['ViewType'] == 'Edit')
        <div class="row mb-2">
            <div class="col-7">
                <h1 class="def_h1_new">{!! print_h1($row) !!}</h1>
            </div>
            <div class="col-5 dir_button">
                <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$row->id)}}" type="morePhoto" :tip="false"/>
                <x-admin.form.action-button url="{{route($PrefixRoute.'.ManageVariants',$row->id)}}" type="morePhoto" :tip="false"/>
                <x-admin.lang.delete-button :row="$row"/>
            </div>
        </div>
    @endif
</x-admin.hmtl.section>