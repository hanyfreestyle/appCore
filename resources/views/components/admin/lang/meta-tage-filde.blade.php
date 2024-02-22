<div class="col-lg-6 {{getColDir($key)}}">
    <x-admin.form.trans-input
        label="{{__('admin/form.title_'.$key)}} ({{ $key}})"
        name="{{ $key }}[name]"
        dir="{{ $key }}"
        reqname="{{ $key }}.name"
        value="{{old($key.'.name',$row->translateOrNew($key)->name)}}"/>
    <x-admin.form.trans-input
        label="{{__('admin/form.meta_g_title_'.$key)}} ({{ ($key) }})"
        name="{{ $key }}[g_title]"
        dir="{{ $key }}"
        reqname="{{ $key }}.g_title"
        :reqspan="$reqspan"
        value="{{old($key.'.g_title',$row->translateOrNew($key)->g_title)}}"/>

    <x-admin.form.trans-text-area
        label="{{__('admin/form.meta_g_des_'.$key)}} ({{ ($key) }})"
        name="{{ $key }}[g_des]"
        dir="{{ $key }}"
        reqname="{{ $key }}.g_des"
        :reqspan="$reqspan"
        value="{{old($key.'.g_des',$row->translateOrNew($key)->g_des)}}"/>
</div>
<div class="col-lg-6 {{getColDir($key)}}">
    <x-admin.form.trans-text-area
        label="{{ __('admin/form.content_'.$key)}} ({{ ($key) }})"
        name="{{ $key }}[des]"
        dir="{{ $key }}"
        reqname="{{ $key }}.des"
        value="{!! old($key.'.des',$row->translateOrNew($key)->des) !!}"/>
</div>
