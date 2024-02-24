<div class="row">

 @foreach ( config('app.web_lang') as $key=>$lang )
  <div class="col-lg-{{getColLang(6)}} {{getColDir($key)}}">

   <x-admin.form.trans-input name="{{ $key }}[label]" label="{{__('admin/config/apps.form_name')}} ({{ $key}})" tdir="{{ $key }}"
                             reqname="{{ $key }}.label" value="{{old($key.'.label', $menu->translate($key)->label ?? '')}}"/>

   <x-admin.form.trans-input name="{{ $key }}[icon]" label="{{__('admin/config/apps.form_icon')}} ({{ $key}})" tdir="en"
                             reqname="{{ $key }}.icon" value="{{old($key.'.icon', $menu->translate($key)->icon ?? '')}}"/>

   <x-admin.form.trans-input name="{{ $key }}[url]" label="{{__('admin/config/apps.form_url')}} ({{ $key}})" tdir="en"
                             reqname="{{ $key }}.url" value="{{old($key.'.url', $menu->translate($key)->url ?? '')}}"/>

  </div>
 @endforeach

</div>

<hr>
<x-admin.form.check-active :row="$menu" lable="{{__('admin/def.status')}}" name="is_active" page-view="{{$pageData['ViewType']}}"/>
<hr>
