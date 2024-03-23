@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.product.form-top-icon :page-data="$pageData" :row="$product"/>

  <div class="productForm">
    <x-admin.hmtl.section>


      <div class="row mb-5">
          <div class="mb-3 d-flex">
            <form action="{{route('Shop.Product.UpdateVariants', $product->id)}}" method="post" enctype="multipart/form-data">
              @csrf
              <ul class="list-unstyled">
                @foreach ($attributeValues as $key => $attrs)
                  <li class="d-flex mb-1">

                    @foreach ($attrs as $attr)
                      <input name="product_variants[{{$key}}][variants][]" class="w-25 form-control mr-1" value="{{$attributeValue[$attr]['name']}}" readonly>
                    @endforeach

                    @foreach ($attrs as $attr)
                      <input name="product_variants[{{$key}}][variants_id][]" class="w-25 form-control mr-1" value="{{$attr}}" type="hidden" >
                    @endforeach

                    <input name="product_variants[{{$key}}][price]" type="text" class="w-25 form-control mr-1" placeholder="Price" value="{{$product->price}}">
                    <input name="product_image[{{$key}}]" type="file" class="w-50 form-control mr-1" placeholder="Image" value="">
                  </li>
                @endforeach
              </ul>
              <div>
                <button class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

      </div>
    </x-admin.hmtl.section>
  </div>
@endsection


@push('JsCode')
  <x-admin.table.sweet-delete-js/>
@endpush
