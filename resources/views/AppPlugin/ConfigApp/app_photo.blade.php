@extends('admin.layouts.app')

@section('content')
 <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
 <x-admin.hmtl.confirm-massage/>
 <form class="mainForm" action="#" method="post">
  @csrf
  <x-admin.hmtl.section>
   <div class="row">

    <x-admin.card.normal col="col-lg-12" :title="__('admin/config/apps.menu_app_photos')">

    </x-admin.card.normal>
   </div>


   <div class="mb-5">
    <x-admin.form.submit text="Edit"/>
   </div>

  </x-admin.hmtl.section>
 </form>

@endsection
