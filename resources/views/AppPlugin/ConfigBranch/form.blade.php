@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post">
                @csrf
                <div class="row">
                    @foreach ( config('app.web_lang') as $key=>$lang )
                        <div class="col-lg-6 {{getColDir($key)}}">
                            <x-admin.form.trans-input
                                label="{{__('admin/config/branch.title')}} ({{ $key}})"
                                name="{{ $key }}[title]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.title"
                                value="{{old($key.'.title',$rowData->translateOrNew($key)->title)}}"
                            />
                            <x-admin.form.trans-text-area
                                label="{{ __('admin/config/branch.address')}} ({{ ($key) }})"
                                name="{{ $key }}[address]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.address"
                                value="{!! old($key.'.address',$rowData->translateOrNew($key)->address) !!}"
                            />

                            <x-admin.form.trans-text-area
                                label="{{ __('admin/config/branch.phone')}} ({{ ($key) }})"
                                name="{{ $key }}[phone]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.phone"
                                value="{!! old($key.'.phone',$rowData->translateOrNew($key)->phone) !!}"
                            />

                            <x-admin.form.trans-text-area
                                label="{{ __('admin/config/branch.work_hours')}} ({{ ($key) }})"
                                name="{{ $key }}[work_hours]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.work_hours"
                                :reqspan="false"
                                value="{!! old($key.'.work_hours',$rowData->translateOrNew($key)->work_hours) !!}"
                            />



                        </div>

                    @endforeach
                </div>

                <div class="row">

                    <x-admin.form.input
                        label="{{__('admin/config/branch.whatsapp')}}"
                        name="whatsapp"
                        colrow="col-lg-4"
                        :required-span="false"
                        value="{{old('whatsapp',$rowData->whatsapp)}}"
                    />


                    <x-admin.form.input
                        label="Latitude"
                        name="lat"
                        colrow="col-lg-4"
                        :required-span="true"
                        value="{{old('lat',$rowData->lat)}}"
                    />
                    <x-admin.form.input
                        label="Longitude"
                        name="long"
                        colrow="col-lg-4"
                        :required-span="true"
                        value="{{old('long',$rowData->long)}}"
                    />
                </div>


                <div class="row">
                    <x-admin.form.input
                        label="Direction Url"
                        name="direction"
                        colrow="col-lg-12"
                        :required-span="false"
                        value="{{old('direction',$rowData->direction)}}"
                    />
                </div>
                <hr>
                <div class="row">
                    <x-admin.form.check-active :row="$rowData" lable="{{__('admin/def.status')}}" name="is_active" page-view="{{$pageData['ViewType']}}"/>
                </div>
                <hr>


                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection
