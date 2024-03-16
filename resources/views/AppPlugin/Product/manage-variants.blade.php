@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.product.form-top-icon :page-data="$pageData" :row="$product"/>

  <div class="productForm">


    <x-admin.hmtl.section>
      @if($errors->has([]))
        <div class="alert alert-danger alert-dismissible">
          {{__('admin/alertMass.form_has_error')}}
        </div>
      @endif

      <div class="row mb-5">
        @if(count($attributes) > 0)
          <x-admin.card.normal>
            <form class="mainForm" action="{{route('Shop.Product.manage-attributeUpdate',$product->id)}}" method="post">
              @csrf
              <div class="row">
                <x-admin.form.select-multiple name="attributes" :categories="$attributes" :col="12"/>
              </div>
              <div class="row float-left ml-1">
                <x-admin.form.submit text="Add"/>
              </div>
            </form>
          </x-admin.card.normal>
        @endif



        @if(count($product->attributes) > 0)
            @foreach($product->attributes as $attribute)
              <x-admin.card.normal :title="$attribute->name">

                <form class="mainForm" action="{{route('Shop.Product.manage-attributeUpdate',$attribute->id)}}" method="post">
                  @csrf
                  <div class="row">
                    <x-admin.form.select-multiple name="attributes_values" :categories="$attribute->Values" :label-view="false" :col="12"/>
                  </div>
                  <div class="row float-left ml-1">
                    <x-admin.form.submit text="Add"/>
                  </div>
                </form>
              </x-admin.card.normal>
            @endforeach


          <x-admin.card.normal>
            <table class="table table-hover">
              <thead>
              <tr>

                <th class="TD_20">#</th>
                <th class="TD_20"></th>
                <th class="TD_200">{{__('admin/proProduct.pro_text_name')}}  {{printLableKey(thisCurrentLocale())}}</th>
              </tr>
              </thead>
              <tbody>
              @foreach($product->attributes as $attribute)
                <tr>
                  <td>{{$attribute->name}}</td>
                  <td>{{$attribute->name}}</td>
                  <td><a href="{{route('Shop.Product.remove-attribute',[$product->id,$attribute->id])}}">remove</a></td>


                </tr>
              @endforeach
              </tbody>
            </table>
          </x-admin.card.normal>
        @endif
      </div>
    </x-admin.hmtl.section>


  </div>





@endsection
{{--            <div class="row">--}}
{{--              <x-admin.form.check-active :row="$rowData" :lable="__('admin/form.check_is_published')" name="is_active"--}}
{{--                                         page-view="{{$pageData['ViewType']}}"/>--}}

{{--            </div>--}}

@push('JsCode')
  <x-admin.table.sweet-delete-js/>


@endpush
