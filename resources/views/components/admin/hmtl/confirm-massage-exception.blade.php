@if(Session::has('fromModel') and Session::get('fromModel') == "CategoryProduct")
  <br> {{__('admin/proProduct.cat_text_name')}} ({{print_h1(Session::get('deleteRow'))}})
  @if(intval(Session::get('deleteRow')->del_category_count) > 0 )
    <br> ({{Session::get('deleteRow')->del_category_count}}) {!! __('admin/proProduct.cat_del_related_cat') !!}
  @endif
  @if(intval(Session::get('deleteRow')->del_product_count) > 0 )
    <br> ({{Session::get('deleteRow')->del_product_count}}) {!! __('admin/proProduct.cat_del_related_pro') !!}
  @endif
@endif