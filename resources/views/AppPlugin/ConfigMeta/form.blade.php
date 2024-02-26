@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($oldData->id))}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-admin.form.input :row="$oldData" label="# CatId" name="cat_id" col="4" tdir="en"/>
                </div>
                <x-admin.main.meta-tage :old-data="$oldData" :placeholder="false" />
                <hr>
                <x-admin.form.upload-file view-type="{{$pageData['ViewType']}}" :row-data="$oldData"
                                          :multiple="false"
                                          thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,$controllerName.'_filterid',0) }}"
                                          :emptyphotourl="$PrefixRoute.'.emptyPhoto'"  />
                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection
