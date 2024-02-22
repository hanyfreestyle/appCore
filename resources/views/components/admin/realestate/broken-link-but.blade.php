<x-admin.hmtl.section>
    <div class="row mb-2">
        <div class="col-7">
            @foreach($BrokenUrl_Arr as $linkPage)
                @if($linkPage['id'] == $from)
                    <h1 class="def_h1_new">{!! $linkPage['name'] !!}</h1>
                @endif
            @endforeach
        </div>
        @if(count($row)>0 and $delete == true)
            @can($PrefixRole.'_delete')
                <div class="col-5 dir_button">
                    <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.DeleteContent',$from)}}" type="deleteContent"/>
                </div>
            @endcan
        @endif
    </div>
</x-admin.hmtl.section>

<x-admin.hmtl.section>
    <div class="row mb-2">
        <div class="col-lg-12">
            @foreach($BrokenUrl_Arr as $linkPage)
                @if($linkPage['id'] == $from )
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.'.$linkPage['id'])}}" print-lable="{{$linkPage['name']}}" size="m" bg="dark" :tip="false"/>
                @else
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.'.$linkPage['id'])}}" print-lable="{{$linkPage['name']}}" size="m" :tip="false"/>
                @endif
            @endforeach
        </div>
    </div>
</x-admin.hmtl.section>
