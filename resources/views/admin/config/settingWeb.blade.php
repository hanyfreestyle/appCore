@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.confirm-massage/>
    <form class="mainForm" action="{{route('admin.webConfigUpdate')}}" method="post">
        @csrf
        <x-admin.hmtl.section>
            <div class="row">
                <x-admin.card.normal col="col-lg-12" title="{{__('admin/config/webConfig.app_menu')}}">
                    <div class="row">

                        <div class="col-lg-5">
                            <div class="row">
                                <x-admin.form.select-arr name="web_status"  sendvalue="{{old('web_status',$setting->web_status)}}"  label="{{__('admin/config/webConfig.status_web')}}" colrow="col-lg-6"  select-type="selActive"/>
                                <x-admin.form.select-arr name="fav_view"  sendvalue="{{old('fav_view',$setting->fav_view)}}"  label="{{__('admin/config/webConfig.status_fav')}}" colrow="col-lg-6"  select-type="selActive"/>
                            </div>
                            <div class="row">
                                <x-admin.form.input name="phone_num" value="{{old('phone_num',$setting->phone_num)}}" label="{{ __('admin/config/webConfig.phone') }}" colrow="col-lg-6" inputclass="dir_en"/>
                                <x-admin.form.input name="phone_call" value="{{old('phone_call',$setting->phone_call)}}" label="{{ __('admin/config/webConfig.phone_call') }}" colrow="col-lg-6" inputclass="dir_en"/>
                            </div>

                            <div class="row">
                                <x-admin.form.input name="whatsapp_num" value="{{old('whatsapp_num',$setting->whatsapp_num)}}" label="{{ __('admin/config/webConfig.whatsapp') }}" colrow="col-lg-6" inputclass="dir_en"/>
                                <x-admin.form.input name="whatsapp_send" value="{{old('whatsapp_send',$setting->whatsapp_send)}}" label="{{ __('admin/config/webConfig.whatsapp_send') }}" colrow="col-lg-6" inputclass="dir_en"/>
                            </div>

                            <div class="row">
                                <x-admin.form.input name="email" value="{{old('email',$setting->email)}}" label="{{ __('admin/config/webConfig.email') }}" colrow="col-lg-12" inputclass="dir_en"/>
                            </div>

                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                @foreach ( config('app.web_lang') as $key=>$lang )
                                    <div class="col-lg-6 {{getColDir($key)}}">

                                        <x-admin.form.trans-input
                                            label="{{__('admin/config/webConfig.website_name_'.$key)}} ({{ $key}})"
                                            name="{{ $key }}[name]"
                                            dir="{{ $key }}"
                                            reqname="{{ $key }}.name"
                                            value="{{old($key.'.name', $setting->translate($key)->name)}}"
                                        />
                                        <x-admin.form.trans-text-area
                                            label="{{__('admin/config/webConfig.closed_mass_'.$key)}} ({{ $key}})"
                                            name="{{ $key }}[closed_mass]"
                                            dir="{{ $key }}"
                                            reqname="{{ $key }}.closed_mass"
                                            value="{{old($key.'.closed_mass', $setting->translate($key)->closed_mass)}}"
                                        />

                                    </div>
                                @endforeach
                            </div>

                        </div>


                    </div>
                </x-admin.card.normal>
                <x-admin.card.normal col="col-lg-12" title="{{__('admin/config/webConfig.social_media')}}">
                    <div class="row">
                        <x-admin.form.input label="Facebook" name="facebook" :requiredSpan="true" colrow="col-lg-6"
                                            value="{{old('facebook',$setting->facebook)}}" inputclass="dir_en"/>

                        <x-admin.form.input label="Youtube" name="youtube" :requiredSpan="true" colrow="col-lg-6"
                                            value="{{old('youtube',$setting->youtube)}}" inputclass="dir_en"/>

                        <x-admin.form.input label="Twitter" name="twitter" :requiredSpan="true" colrow="col-lg-6"
                                            value="{{old('twitter',$setting->twitter)}}" inputclass="dir_en"/>

                        <x-admin.form.input label="Instagram" name="instagram" :requiredSpan="true" colrow="col-lg-6"
                                            value="{{old('instagram',$setting->instagram)}}" inputclass="dir_en"/>

                        <x-admin.form.input label="Google Api" name="google_api" :requiredSpan="true" colrow="col-lg-12"
                                            value="{{old('google_api',$setting->google_api)}}" inputclass="dir_en"/>
                    </div>
                </x-admin.card.normal>
            </div>
            <div class="mb-5">
                <x-admin.form.submit  text="Edit" />
            </div>

        </x-admin.hmtl.section>
    </form>

@endsection
