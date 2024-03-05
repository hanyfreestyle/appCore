<x-admin.hmtl.section>
  @if($pageData['ViewType'] == 'Edit')
    <div class="row mb-2">
      <div class="col-9">
        <h1 class="def_h1_new">{!! print_h1($row) !!}</h1>
      </div>
      <div class="col-3 dir_button">
        @if(isset($pageData['AddMorePhoto']) and $pageData['AddMorePhoto'] == true)
          <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$row->id)}}" type="morePhoto" :tip="false"/>
        @endif

        @if(isset($pageData['AddLang']) and $pageData['AddLang'] == true )
          <x-admin.lang.delete-button :row="$row"/>
        @endif
      </div>
    </div>
  @endif
</x-admin.hmtl.section>