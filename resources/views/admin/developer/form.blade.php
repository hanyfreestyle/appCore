@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"  />

    <x-admin.hmtl.section>
        @if($pageData['ViewType'] == 'Edit')
            <div class="content mb-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-9">
                            <h1 class="def_h1_new">{!! print_h1($Developer) !!}</h1>
                        </div>
                        <div class="col-3 dir_button">
                            <x-admin.form.action-button url="{{route('developer.More_Photos',$Developer->id)}}" type="morePhoto" :tip="false" bg="dark" />
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <x-admin.card.def :page-data="$pageData"  >
            <form  class="mainForm" action="{{route('developer.update',intval($Developer->id))}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-admin.form.input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-12 {{getColDir('en')}}"
                                        value="{{old('slug',$Developer->slug)}}"  dir="en" inputclass="dir_en"/>
                </div>

                <div class="row">
                    @foreach ( config('app.web_lang') as $key=>$lang )
                        <div class="col-lg-6 {{getColDir($key)}}">
                            <x-admin.form.trans-input
                                label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                                name="{{ $key }}[name]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.name"
                                value="{{old($key.'.name',$Developer->translateOrNew($key)->name)}}"
                            />
                            <x-admin.form.trans-text-area
                                label="{{ __('admin/form.des_'.$key)}} ({{ ($key) }})"
                                name="{{ $key }}[des]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.des"
                                value="{!! old($key.'.des',$Developer->translateOrNew($key)->des) !!}"
                            />

                        </div>
                    @endforeach
                </div>

                <x-admin.main.meta-tage  :body-h1="false" :breadcrumb="false"  :old-data="$Developer" :placeholder="false" />

                <hr>

                <div class="row">
                    <x-admin.form.check-active  :row="$Developer" name="is_active" page-view="{{$pageData['ViewType']}}"/>
                </div>

                <hr>
                <x-admin.form.upload-model-photo :page-data="$pageData" :row="$Developer" />
                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>



@endsection

@push('JsCode')
    <x-admin.form.ckeditor-jave  />
@endpush
