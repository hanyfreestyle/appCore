@if($btype == 'Edit')
    <x-admin.form.action-button url='{{route($PrefixRoute.".edit",$row->id)}}' type='edit' />
@elseif($btype == 'MorePhoto')
    <x-admin.form.action-button url='{{route($PrefixRoute.".More_Photos",$row->id)}}' type='morePhoto' />
@elseif($btype == 'Delete')
    <a href="#" id="{{route($PrefixRoute.'.destroy',$row->id)}}" onclick="sweet_dalete(this.id)"  class="edit btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
@elseif($btype == 'addLang')
    @if(!isset($row->translate('ar')->name))
        <x-admin.form.action-button url="{{route($PrefixRoute.'.editAr',$row->id)}}"  icon="fa-solid fa-globe" :tip="true" print-lable="{{__('admin/config/core.multiple_lang_menu_ar')}}" />
    @elseif(!isset($row->translate('en')->name))
        <x-admin.form.action-button url="{{route($PrefixRoute.'.editEn',$row->id)}}"  icon="fa-solid fa-globe" :tip="true" print-lable="{{__('admin/config/core.multiple_lang_menu_en')}}" />
    @endif

@elseif($btype == 'CatName')
    @foreach($row->categories as $Category )
        <a href="{{route($PrefixRoute.'.ListCategory',$Category->id)}}">
            <span class="cat_table_name">{{ print_h1($Category)}}</span>
        </a>
    @endforeach
@elseif($btype == 'OldPhotos')
    <x-admin.form.action-button url="{{route($PrefixRoute.'.Old_Photos',$row->id)}}" :viewbut="$row->slider_active" type="old"/>
@elseif($btype == 'ViewListing')
    <x-admin.form.action-button url="{{route('page_ListView',$row->slug)}}" bg="dark" icon="fa fa-eye" :target="true"/>
@elseif($btype == 'ProjectPhoto')
    <x-admin.table.icon-with-count  name="Photo" icon="fas fa-images" :count="$row->admin_more_photos_count" url="{{route($PrefixRoute.'.More_Photos',$row->id)}}" />
@elseif($btype == 'ProjectFaq')
    <x-admin.table.icon-with-count  name="FAQ" icon="fas fa-question" :count="$row->admin_faqs_count" url="{{route($PrefixRoute.'.faq_list',$row->id)}}" />
@elseif($btype == 'ProjectUnits')
    <x-admin.table.icon-with-count  name="Units" icon="fas fa-bath" :count="$row->admin_units_count" url="{{route($PrefixRoute.'.ProjectUnits.index',$row->id)}}" />
@endif






