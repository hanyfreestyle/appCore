@if(count(config('app.web_lang')) > 1)
  <div class="col-lg-12">
    <div class="LangHeader">{{$keyLang}}</div>
  </div>
@endif

<div class="col-lg-6">
  <div class="row">
  <x-admin.form.trans-input name="name" :key="$key" :row="$row" :label="__('admin/proProduct.cat_text_name')" :tdir="$key"
                            :label-view="$labelView" :holder="$holder" />
  <x-admin.form.trans-input name="g_title" :key="$key" :row="$row" :label="__('admin/form.text_g_title')" :tdir="$key"
                            :label-view="$labelView" :holder="$holder" />
  <x-admin.form.trans-text-area name="g_des" :key="$key" :row="$row" :label="__('admin/form.text_g_des')" :tdir="$key"
                                :label-view="$labelView" :holder="$holder" />
  @if($slug)
    <x-admin.form.trans-input name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key"
                              :label-view="$labelView" :holder="$holder"/>
  @endif
  </div>
</div>
<div class="col-lg-6">
  <div class="row">
    <x-admin.form.trans-text-area name="des" :key="$key" :row="$row" :label="__('admin/form.text_content')" :tdir="$key"
                                  add-class="bigTextArea" :label-view="$labelView" :holder="$holder" />
  </div>
</div>







