@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-9">
                <h1 class="def_h1_new">{!! print_h1($Project) !!}</h1>
            </div>
            <div class="col-3 dir_button">
                <x-admin.form.action-button  url="{{route('project.faq_list', $Project->id)}}" type="back" />
            </div>
        </div>
   </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-12">
                <x-admin.card.def :page-data="$pageData"  >
                    <form  class="mainForm" action="{{route('project.faq_update',intval($ProjectQuestion->id))}}" method="post" >
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $Project->id }}">
                        <div class="row">
                            @foreach ( config('app.web_lang') as $key=>$lang )
                                <div class="col-lg-6 {{getColDir($key)}}">


                                    <x-admin.form.trans-input

                                        label="{{__('admin/form.faq_question_'.$key)}} ({{ $key}})"
                                        name="{{ $key }}[question]"
                                        dir="{{ $key }}"
                                        reqname="{{ $key }}.question"
                                        value="{{old($key.'.question',$ProjectQuestion->translateOrNew($key)->question)}}"
                                    />
                                    <x-admin.form.trans-text-area
                                        label="{{ __('admin/form.faq_answer_'.$key)}} ({{ ($key) }})"
                                        name="{{ $key }}[answer]"
                                        dir="{{ $key }}"
                                        reqname="{{ $key }}.answer"
                                        value="{{ old($key.'.answer',$ProjectQuestion->translateOrNew($key)->answer) }}"
                                    />

                                </div>
                            @endforeach
                        </div>

                        <div class="container-fluid">
                            <x-admin.form.submit text="{{$pageData['ViewType']}}" />
                        </div>
                    </form>

                </x-admin.card.def>
            </div>

        </div>
   </x-admin.hmtl.section>
@endsection


@push('JsCode')

@endpush

