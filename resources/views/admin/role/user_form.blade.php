@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def  :page-data="$pageData" >

            <form  data-parsley-validate class="mainForm" action="{{route($PrefixRoute.'.update',intval($users->id))}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12">

                    <div class="row">
                        <x-admin.form.input name="name" value="{{old('name',$users->name)}}" label="{{__('admin/config/roles.users_fr_name')}}"
                                              colrow="col-lg-4" inputclass="dir_en"/>

                        <x-admin.form.input name="email" value="{{old('email',$users->email)}}" label="{{__('admin/config/roles.users_fr_email')}}"
                                            colrow="col-lg-4" inputclass="dir_en"/>

                        <x-admin.form.input name="phone" value="{{old('phone',$users->phone)}}" label="{{__('admin/config/roles.users_fr_phone')}}"
                                            colrow="col-lg-4" inputclass="dir_en"/>

                        <x-admin.form.input name="user_password" value="{{ old('user_password') }}" label="{{__('admin/form.password')}}"
                                            :requiredSpan="$pageData['passReq']" colrow="col-lg-4" type="password" inputclass="dir_en"/>

                        <x-admin.form.input name="user_password_confirmation" value="{{old('user_password_confirmation')}}" label="{{__('admin/form.password_confirm')}}"
                                            :requiredSpan="$pageData['passReq']" colrow="col-lg-4" type="password" inputclass="dir_en"/>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('admin/config/roles.users_fr_role')}}</label>
                                @php
                                    $printName = getRoleName();
                                @endphp
                                <select class="select2  @error('roles') is-invalid @enderror" name="roles[]" multiple="multiple" data-placeholder="{{__('admin/config/roles.users_fr_role_selone')}}" style="width: 100%;"  >
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}" @if(isset($userRole[$role->id])) selected @endif >{{ $role->$printName }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ \App\Helpers\AdminHelper::error($errors->first('roles'),'roles',"hany") }}</strong>
                            </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <x-admin.form.upload-file  view-type="{{$pageData['ViewType']}}" :row-data="$users" thisfilterid="1"
                                               :emptyphotourl="$PrefixRoute.'.emptyPhoto'" :multiple="false"/>
                </div>


                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>

        </x-admin.card.def>
   </x-admin.hmtl.section>


@endsection

