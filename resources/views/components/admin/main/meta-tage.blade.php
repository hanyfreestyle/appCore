<div class="row">

    @foreach ( config('app.web_lang') as $key=>$lang )
        <div class="col-lg-6 {{getColDir($key)}}">


            <x-admin.form.trans-input :placeholder="$placeholder"
                           label="{{__('admin/form.meta_g_title_'.$key)}} ({{ ($key) }})"
                           name="{{ $key }}[g_title]"
                           dir="{{ $key }}"
                           reqname="{{ $key }}.g_title" :reqspan="false"
                           value="{!! old($key.'.g_title',$oldData->translateOrNew($key)->g_title) !!}"

            />

            <x-admin.form.trans-text-area :placeholder="$placeholder"
                               label="{{__('admin/form.meta_g_des_'.$key)}} ({{ ($key) }})"
                               name="{{ $key }}[g_des]"
                               dir="{{ $key }}"
                               reqname="{{ $key }}.g_des"
                               :reqspan="false"
                               value="{!! old($key.'.g_des',$oldData->translateOrNew($key)->g_des) !!}"
            />

            @if($bodyH1 == true)
                <x-admin.form.trans-input
                    :placeholder="$placeholder"
                    label="{{__('admin/form.meta_bodyH1_'.$key)}} ({{ ($key) }})"
                    name="{{ $key }}[body_h1]"
                    dir="{{ $key }}"
                    reqname="{{ $key }}.body_h1"
                    value="{{old($key.'.body_h1',$oldData->translateOrNew($key)->body_h1)}}"
                    :reqspan="false"
                />
            @endif


            @if($breadcrumb == true)
                <x-admin.form.trans-input
                    :placeholder="$placeholder"
                    label="{{__('admin/form.meta_breadcrumb_'.$key)}} ({{ ($key) }})"
                    name="{{ $key }}[breadcrumb]"
                    dir="{{ $key }}"
                    reqname="{{ $key }}.breadcrumb"
                    value="{{old($key.'.breadcrumb',$oldData->translateOrNew($key)->breadcrumb)}}"
                    :reqspan="false"
                />
            @endif


        </div>
    @endforeach
</div>
