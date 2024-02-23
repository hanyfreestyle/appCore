@extends('admin.layouts.app')

@section('content')


    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">

            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post">
                @csrf
                <div class="row">
                    <x-admin.form.input label="{{__('admin/def.form_name_ar')}}" name="name" :requiredSpan="true" colrow="col-lg-4"
                                        value="{{old('cat_id',$rowData->name)}}" inputclass="dir_ar"/>
                </div>

                <div class="row">
                    @foreach ( config('app.web_lang') as $key=>$lang )
                        <div class="col-lg-6 {{getColDir($key)}}">
                            <x-admin.form.trans-input
                                label="H1 ({{ $key}})"
                                name="{{ $key }}[h1]"
                                inputid="h1_{{ $key }}"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.h1"
                                value="{{old($key.'.h1',$rowData->translateOrNew($key)->h1)}}"
                            />

                            <x-admin.form.trans-input
                                label="H2 ({{ $key}})"
                                name="{{ $key }}[h2]"
                                inputid="h2_{{ $key }}"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.h2"
                                :reqspan="false"
                                value="{{old($key.'.h2',$rowData->translateOrNew($key)->h2)}}"
                            />
                            <x-admin.form.trans-text-area
                                label="{{ __('admin/form.des_'.$key)}} ({{ ($key) }})"
                                name="{{ $key }}[des]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.des"
                                :reqspan="false"
                                value="{!! old($key.'.des',$rowData->translateOrNew($key)->des) !!}"
                            />

                            <x-admin.form.trans-text-area
                                label="{{ __('admin/form.des_'.$key)}} ({{ ($key) }})"
                                name="{{ $key }}[lists]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.lists"
                                :reqspan="false"
                                value="{!! old($key.'.lists',$rowData->translateOrNew($key)->lists) !!}"
                            />
                        </div>

                    @endforeach
                </div>


                <x-admin.form.submit-role-back :page-data="$pageData" />

            </form>

        </x-admin.card.def>

    </x-admin.hmtl.section>

@endsection
