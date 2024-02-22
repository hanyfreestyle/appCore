@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"  />
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData"  >

            @if ($errors->has('hash_send'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissible">
                            {{ $errors->first('hash_send') }}
                        </div>
                    </div>
                </div>
            @endif
            <form  class="mainForm" action="{{route('pages.update',intval($Page->id))}}" method="post"  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <x-admin.form.select-arr  name="location_id" label="{{__('admin/project.loction')}}" :sendvalue="old('location_id',$Page->location_id)" :required-span="false" colrow="col-lg-4 " :send-arr="$CashLocationList"/>
                    <x-admin.form.select-arr  name="compound_id" label="{{__('admin/page.mod_compound')}}" select-type="changeLang" :sendvalue="old('compound_id',$Page->compound_id)" :required-span="false" colrow="col-lg-8 " :send-arr="$CashCompoundList"/>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{__('admin/page.mod_property_type')}}</label>
                            <select class="select2" name="property_type[]" multiple="multiple" data-placeholder="{{__('admin/page.mod_property_type_placeholder')}}" style="width: 100%;"  data-parsley-required="true" >
                                @foreach($Property_TypeArr as $Property_Type)
                                    <option value="{{$Property_Type['id']}}" {{ in_array($Property_Type['id'],old('property_type',$Page->property_type)) ? 'selected' : '' }}  >{{ $Property_Type['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{__('admin/page.mod_page_links')}}</label>
                            <select class="select2" name="links[]" multiple="multiple" data-placeholder="{{__('admin/page.mod_page_links_placeholder')}}" style="width: 100%;"  data-parsley-required="true" >
                                @foreach($CashPagesData as $pageDataRow)
                                    @if($pageDataRow->id != $Page->id)
                                        <option value="{{$pageDataRow->id}}" {{ in_array($pageDataRow->id,old('links',$Page->links)) ? 'selected' : '' }}  >{{ $pageDataRow->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ( config('app.web_lang') as $key=>$lang )
                        <div class="col-lg-6 {{getColDir($key)}}">
                            <x-admin.form.trans-input
                                label="{{__('admin/form.title_'.$key)}} ({{ $key}})"
                                name="{{ $key }}[name]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.name"
                                value="{{old($key.'.name',$Page->translateOrNew($key)->name)}}"
                            />
                            <x-admin.form.trans-text-area
                                label="{{ __('admin/form.content_'.$key)}} ({{ ($key) }})"
                                name="{{ $key }}[des]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.des"
                                value="{!! old($key.'.des',$Page->translateOrNew($key)->des) !!}"
                            />
                        </div>
                    @endforeach
                </div>

                <x-admin.main.meta-tage :body-h1="false" :breadcrumb="false"  :old-data="$Page" :placeholder="false" />

                <hr>

                <div class="row">
                    <x-admin.form.check-active  :row="$Page" lable="{{__('admin/form.is_published')}}" name="is_active" page-view="{{$pageData['ViewType']}}"/>
                </div>

                <hr>
                <x-admin.form.submit-role-back :page-data="$pageData" />

            </form>

        </x-admin.card.def>
   </x-admin.hmtl.section>



@endsection


@push('JsCode')
    <x-admin.form.ckeditor-jave />
@endpush
