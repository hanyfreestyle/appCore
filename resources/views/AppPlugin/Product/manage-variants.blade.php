@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.product.form-top-icon :page-data="$pageData" :row="$product"/>

  <div class="productForm">


    <x-admin.hmtl.section>


      <div class="row mb-5">
        @foreach($product->attributes as $attribute)

          {{$attribute->name}}<br>



        @endforeach

      </div>
    </x-admin.hmtl.section>


  </div>





@endsection


@push('JsCode')
  <x-admin.table.sweet-delete-js/>


@endpush
