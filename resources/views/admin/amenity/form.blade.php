@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">


            <form  class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post"  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="view_type" value="{{$pageData['ViewType']}}">
                <div class="col-lg-12">
                    <div class="row">
                        @foreach ( config('app.web_lang') as $key=>$lang )
                            <div class="col-lg-6 {{getColDir($key)}}">
                                <x-admin.form.trans-input
                                    label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                                    name="{{ $key }}[name]"
                                    dir="{{ $key }}"
                                    reqname="{{ $key }}.name"
                                    value="{{old($key.'.name',$rowData->translateOrNew($key)->name)}}"
                                />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group col-lg-4" style="direction: ltr!important;">
                    <label class="col-form-label font-weight-light " for="">Icon</label>
                    <div class="" style="direction: ltr!important;">
                        <input type="hidden" name="icon" id="icon_hidden_filde" value="{{old('icon',$rowData->icon)}}"  >
                        <button class="btn btn-primary"
                                data-align="center"
                                data-icon="{{old('icon',$rowData->icon)}}" id="iconpicker_target" role="iconpicker"></button>
                    </div>
                </div>
                <hr>

                <x-admin.form.upload-model-photo :page-data="$pageData" :row="$rowData" />
                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>


@endsection


@push('JsCode')
    <script src="{{defAdminAssets('plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
    <script>
        $('#iconpicker_target').on('change', function(e) {
            $("#icon_hidden_filde").val(e.icon);
        });
    </script>
@endpush



