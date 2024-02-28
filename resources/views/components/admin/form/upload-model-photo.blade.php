<div class="col-lg-{{$col}}">
  <x-admin.form.upload-file  view-type="{{$pageData['ViewType']}}" :row-data="$row"
                             :multiple="false"
                             file-name="{{$file}}"
                             fild-name="{{$filde}}"
                             filter-name="{{$filterName}}"
                             thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,$controllerName.$filter,0) }}"
                             :emptyphotourl="$PrefixRoute.$route"  />

</div>
