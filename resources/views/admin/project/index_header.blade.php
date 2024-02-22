<thead>
<tr>
    <th class="TD_20">#</th>
    <th class="TD_20"></th>
    <th class="TD_350">{{__('admin/def.form_name_ar')}}</th>
    <th class="TD_350">{{__('admin/def.form_name_en')}}</th>
    <th class="TD_20"></th>

    @if($pageData['ViewType'] == 'deleteList')
        <x-admin.table.soft-delete />
    @else
        <x-admin.table.action-but po="top" type="edit"/>
        <x-admin.table.action-but po="top" type="edit"/>
        <x-admin.table.action-but po="top" type="edit"/>
        <x-admin.table.action-but po="top" type="edit"/>
        <x-admin.table.action-but po="top" type="edit"/>
        <x-admin.table.action-but po="top" type="edit"/>
        <x-admin.table.action-but po="top" type="delete"/>
        <th class="td_action"></th>
    @endif
</tr>
</thead>
