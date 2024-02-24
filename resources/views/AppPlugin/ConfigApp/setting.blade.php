@extends('admin.layouts.app')

@section('content')
 <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
 <x-admin.hmtl.confirm-massage/>
 <form class="mainForm" action="{{route('App.AppSetting.AppSettingUpdate')}}" method="post">
  @csrf
  <x-admin.hmtl.section>
   <div class="row">

    <x-admin.card.normal col="col-lg-5" :title="__('admin/config/apps.box_general_settings')">
     <div class="row">
      <x-admin.form.select-arr name="status" sendvalue="{{old('status',$setting->status)}}"
                               label="{{__('admin/config/apps.set_status')}}" colrow="col-lg-6"
                               select-type="selActive"/>
     </div>
     <div class="row">
      @foreach ( config('app.web_lang') as $key=>$lang )
       <div class="col-lg-{{getColLang(6)}} {{getColDir($key)}}">
        <x-admin.form.trans-input name="{{ $key }}[AppName]"
                                  label="{{__('admin/config/apps.set_app_name')}} ({{ $key}})"
                                  dir="{{ $key }}"
                                  reqname="{{ $key }}.AppName"
                                  value="{{old($key.'.AppName', $setting->translate($key)->AppName ?? '')}}"
        />
       </div>
      @endforeach
      <x-admin.form.input :row="$setting" name="baseUrl" label="Base Url" col="12" tdir="en"/>
      <x-admin.form.input :row="$setting" name="mobilePrefix" label="Mobile Prefix" col="12" tdir="en"/>
      <x-admin.form.input :row="$setting" name="prefix" label="Prefix" col="12" tdir="en"/>
     </div>
    </x-admin.card.normal>

    <x-admin.card.normal col="col-lg-7" :title="__('admin/config/apps.box_app_setting')">
     <div class="row">
      <x-admin.form.input :row="$setting" name="ColorDark" label="ColorDark" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="ColorLight" label="ColorLight" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="AppBarIconColor" label="AppBarIconColor" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="BackGroundColor" label="BackGroundColor" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="SplashColor" label="SplashColor" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="PreloadingColor" label="PreloadingColor" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="StatueBArColor" label="StatueBArColor" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="AppBarColor" label="AppBarColor" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="AppBarColorText" label="AppBarColorText" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="sideMenuText" label="sideMenuText" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="sideMenuColor" label="sideMenuColor" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="mainScreenScale" label="mainScreenScale" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="sideMenuAngle" label="sideMenuAngle" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="sideMenuStyle" label="sideMenuStyle" col="4" tdir="en"/>
      <x-admin.form.input :row="$setting" name="AppTheme" label="AppTheme" col="4" tdir="en"/>

     </div>
    </x-admin.card.normal>


    <x-admin.card.normal col="col-lg-12" title="{{__('admin/config/apps.box_social_media')}}">
     <div class="row">
      <x-admin.form.input :row="$setting" name="facebook" label="facebook" col="6" tdir="en"/>
      <x-admin.form.input :row="$setting" name="youtube" label="youtube" col="6" tdir="en"/>
      <x-admin.form.input :row="$setting" name="twitter" label="twitter" col="6" tdir="en"/>
      <x-admin.form.input :row="$setting" name="instagram" label="instagram" col="6" tdir="en"/>
      <x-admin.form.input :row="$setting" name="linkedin" label="linkedin" col="6" tdir="en"/>
     </div>
    </x-admin.card.normal>

    <x-admin.card.normal col="col-lg-6" title="WhatsApp">
     <div class="row">
      <x-admin.form.input :row="$setting" name="whatsAppNumber" label="whatsApp Number" col="12" tdir="en"/>
      @foreach ( config('app.web_lang') as $key=>$lang )
       <div class="col-lg-{{getColLang(6)}} {{getColDir($key)}}">
        <x-admin.form.trans-input name="{{ $key }}[whatsAppMessage]"
                                  label="whatsAppMessage ({{ $key}})"
                                  dir="{{ $key }}"
                                  reqname="{{ $key }}.whatsAppMessage"
                                  value="{{old($key.'.whatsAppMessage', $setting->translate($key)->whatsAppMessage ?? '')}}"
        />
       </div>
      @endforeach
      <x-admin.form.input :row="$setting" name="whatsAppKey" label="whatsApp Key" col="12" tdir="en"/>
     </div>
    </x-admin.card.normal>

    <x-admin.card.normal col="col-lg-6" title="Telegram">
     <div class="row">
      <x-admin.form.input :row="$setting" name="telegram_key" label="Telegram Key" col="12" tdir="en"/>
      <x-admin.form.input :row="$setting" name="telegram_group" label="Telegram Group" col="12" tdir="en"/>
      <x-admin.form.input :row="$setting" name="telegram_phone" label="Telegram Phone" col="12" tdir="en"/>
     </div>
    </x-admin.card.normal>


   </div>


   <div class="mb-5">
    <x-admin.form.submit text="Edit"/>
   </div>

  </x-admin.hmtl.section>
 </form>

@endsection
