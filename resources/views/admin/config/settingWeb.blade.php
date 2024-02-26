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
                <x-admin.form.select-arr name="web_status" :sendvalue="old('web_status',$setting->web_status)"
                                         :label="__('admin/config/webConfig.status_web')" col="6" select-type="selActive"/>
                <x-admin.form.select-arr name="fav_view" :sendvalue="old('fav_view',$setting->fav_view)"
                                         :label="__('admin/config/webConfig.status_fav')" col="6" select-type="selActive"/>
              </div>
              <div class="row">
                <x-admin.form.input :row="$setting" name="phone_num" :label="__('admin/config/webConfig.phone')" col="6" tdir="en"/>
                <x-admin.form.input :row="$setting" name="phone_call" :label="__('admin/config/webConfig.phone_call')" col="6" tdir="en"/>
                <x-admin.form.input :row="$setting" name="whatsapp_num" :label="__('admin/config/webConfig.whatsapp')" col="6" tdir="en"/>
                <x-admin.form.input :row="$setting" name="whatsapp_send" :label="__('admin/config/webConfig.whatsapp_send')" col="6"
                                    tdir="en"/>
              </div>

              <div class="row">
                <x-admin.form.input :row="$setting" name="email" :label="__('admin/config/webConfig.email')" col="12" tdir="en"/>
              </div>

            </div>
            <div class="col-lg-7">
              <div class="row">
                @foreach ( config('app.web_lang') as $key=>$lang )
                  <div class="col-lg-{{getColLang(6)}}">
                    <x-admin.form.trans-input name="name" :row="$setting" :key="$key" :tdir="$key"
                                              :label="__('admin/config/webConfig.website_name')"/>
                    <x-admin.form.trans-text-area name="closed_mass" :row="$setting" :key="$key" :tdir="$key"
                                                  :label="__('admin/config/webConfig.closed_mass')"/>
                  </div>
                @endforeach
              </div>

            </div>
          </div>

        </x-admin.card.normal>
        <x-admin.card.normal col="col-lg-6" title="{{__('admin/config/webConfig.social_media')}}">
          <div class="row">
            <x-admin.form.input :row="$setting" name="facebook" label="Facebook" col="12" tdir="en"/>
            <x-admin.form.input :row="$setting" name="youtube" label="Youtube" col="12" tdir="en"/>
            <x-admin.form.input :row="$setting" name="twitter" label="Twitter" col="12" tdir="en"/>
            <x-admin.form.input :row="$setting" name="instagram" label="Instagram" col="12" tdir="en"/>
            <x-admin.form.input :row="$setting" name="google_api" label="Google Api" col="12" tdir="en"/>
          </div>
        </x-admin.card.normal>
      </div>
      <div class="mb-5">
        <x-admin.form.submit text="Edit"/>
      </div>

    </x-admin.hmtl.section>
  </form>

@endsection