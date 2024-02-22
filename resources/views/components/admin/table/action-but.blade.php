@if($po == 'top')
    @if($type == 'edit')
        @can($PrefixRole.'_edit')
            <th class="td_action"></th>
        @endcan
    @elseif($type == 'delete')
        @can($PrefixRole.'_delete')
            <th class="td_action"></th>
        @endcan
    @elseif($type == 'deleteAll')
        @can($PrefixRole.'_delete')
            <th class="tdc"><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>
        @endcan
    @endif
@elseif($po == 'button')
    @if($type == 'edit')
        @can($PrefixRole.'_edit')
            @if($modelid)
                <td class="td_action"><x-admin.form.action-button url="{{route($PrefixRoute.'.edit',[$modelid,$row->id])}}" type="edit"/></td>
            @else
                <td class="td_action"><x-admin.form.action-button url="{{route($PrefixRoute.'.edit',$row->id)}}" type="edit"/></td>
            @endif
        @endcan
    @elseif($type == 'addLang')
        @can($PrefixRole.'_edit')
            @if($modelid)
                <x-admin.lang.add-new-button  :row="$row" :modelid="$modelid" />
            @else
                <x-admin.lang.add-new-button  :row="$row" />
            @endif
        @endcan
    @elseif($type == 'Photos')
        @can($PrefixRole.'_edit')
            @if($modelid)
                <td class="td_action"><x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',[$modelid,$row->id])}}" type="morePhoto" :count="$row->admin_more_photos_count" /></td>
            @else
                <td class="td_action"><x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$row->id)}}" type="morePhoto" :count="$row->admin_more_photos_count" /></td>
            @endif
        @endcan
    @elseif($type == 'delete')
        @can($PrefixRole.'_delete')
            <td class="td_action"><x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.destroy',$row->id)}}" type="deleteSweet"/></td>
        @endcan
    @elseif($type == 'liveDelete')
        @can($PrefixRole.'_delete')
            <td class="td_action"><x-admin.form.action-button url="#" id="{{$row->id}}" type="liveDelete"/></td>
        @endcan
    @elseif($type == 'deleteAll')
        @can($PrefixRole.'_delete')
            <td class="tdc"><input type="checkbox" name="ids[]" value="{{$row->id}}" class=""></td>
        @endcan
    @elseif($type == 'OldPhotos')
        @can($PrefixRole.'_edit')
            @if($modelid)
                <td class="td_action"><x-admin.form.action-button url="{{route($PrefixRoute.'.Old_Photos',[$modelid,$row->id])}}" :viewbut="$row->slider_active" type="old"/></td>
            @else
                <td class="td_action"><x-admin.form.action-button url="{{route($PrefixRoute.'.Old_Photos',$row->id)}}" :viewbut="$row->slider_active" type="old"/></td>
            @endif
        @endcan

    @elseif($type == 'ProjectBut')
        @can($PrefixRole.'_edit')

            <td class="td_pro_icon"><x-admin.table.icon-with-count  name="Units" icon="fas fa-bath"
                                                                    :count="$row->admin_units_count"
                                                                    url="{{route($PrefixRoute.'.ProjectUnits.index',$row->id)}}" /></td>

            <td class="td_pro_icon"><x-admin.table.icon-with-count  name="Photo" icon="fas fa-images"
                                                                    :count="$row->admin_more_photos_count"
                                                                    url="{{route($PrefixRoute.'.More_Photos',$row->id)}}" /></td>

            <td class="td_pro_icon"><x-admin.table.icon-with-count  name="FAQ" icon="fas fa-question"
                                                                    :count="$row->admin_faqs_count"
                                                                    url="{{route($PrefixRoute.'.faq_list',$row->id)}}" /></td>
        @endcan
    @endif

@endif
