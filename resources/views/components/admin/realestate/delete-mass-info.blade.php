@if(Session::has('fromModel') and Session::get('fromModel') == "Project")
    <br> {{__('admin/deleteMass.model_project')}} ({{print_h1(Session::get('deleteRow'))}})

    @if(intval(Session::get('deleteRow')->del_units_count) > 0 )
        <br> ({{Session::get('deleteRow')->del_units_count}}) {!! __('admin/deleteMass.related_units') !!}
    @endif
    @if(intval(Session::get('deleteRow')->del_pages_count) > 0 )
        <br>({{Session::get('deleteRow')->del_pages_count}}) {!! __('admin/deleteMass.related_page') !!}
    @endif
    @if(intval(Session::get('deleteRow')->del_posts_count) > 0 )
        <br>({{Session::get('deleteRow')->del_posts_count}}) {!! __('admin/deleteMass.related_post') !!}
    @endif
@elseif(Session::has('fromModel') and Session::get('fromModel') == "Developer")
    <br> {{__('admin/deleteMass.model_developer')}} ({{print_h1(Session::get('deleteRow'))}})

    @if(intval(Session::get('deleteRow')->del_listings_count) > 0 )
        <br>({{Session::get('deleteRow')->del_listings_count}}) {!! __('admin/deleteMass.related_listing') !!}
    @endif

    @if(intval(Session::get('deleteRow')->del_posts_count) > 0 )
        <br>({{Session::get('deleteRow')->del_posts_count}}) {!! __('admin/deleteMass.related_post') !!}
    @endif
@elseif(Session::has('fromModel') and Session::get('fromModel') == "Location")
    <br> {{__('admin/deleteMass.model_location')}} ({{print_h1(Session::get('deleteRow'))}})

    @if(intval(Session::get('deleteRow')->del_locations_count) > 0 )
        <br>({{Session::get('deleteRow')->del_locations_count}}) {!! __('admin/deleteMass.related_location') !!}
    @endif

    @if(intval(Session::get('deleteRow')->del_listings_count) > 0 )
        <br>({{Session::get('deleteRow')->del_listings_count}}) {!! __('admin/deleteMass.related_listing') !!}
    @endif

    @if(intval(Session::get('deleteRow')->del_pages_count) > 0 )
        <br>({{Session::get('deleteRow')->del_pages_count}}) {!! __('admin/deleteMass.related_page') !!}
    @endif

    @if(intval(Session::get('deleteRow')->del_posts_count) > 0 )
        <br>({{Session::get('deleteRow')->del_posts_count}}) {!! __('admin/deleteMass.related_post') !!}
    @endif

@elseif(Session::has('fromModel') and Session::get('fromModel') == "Category")
    <br> {{__('admin/deleteMass.model_category')}} ({{print_h1(Session::get('deleteRow'))}})

    @if(intval(Session::get('deleteRow')->del_posts_count) > 0 )
        <br>({{Session::get('deleteRow')->del_posts_count}}) {!! __('admin/deleteMass.related_post') !!}
    @endif
@endif




