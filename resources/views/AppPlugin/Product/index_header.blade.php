<thead>
<tr>
  <th class="TD_20">#</th>
  <th class="TD_20"></th>
  @foreach(config('app.web_lang') as $key => $lang)
    <th class="TD_200">{{__('admin/proProduct.pro_text_name')}}  {{printLableKey($key)}}</th>
  @endforeach

  @if($pageData['ViewType'] == 'deleteList')
    <x-admin.table.soft-delete/>
  @else
    <th class="TD_200">{{__('admin/proProduct.cat_text_name')}}</th>
    <th class="TD_80">{{__('admin/proProduct.pro_text_price')}}</th>
    <th class="TD_80">{{__('admin/proProduct.pro_text_discount')}}</th>
    <th class="TD_80">{{__('admin/proProduct.pro_text_qty')}}</th>

    <th class="TD_20"></th>
    <x-admin.table.action-but po="top" type="edit"/>
    <x-admin.table.action-but po="top" type="addLang"/>
    <x-admin.table.action-but po="top" type="edit"/>
    <x-admin.table.action-but po="top" type="delete"/>
  @endif
</tr>
</thead>