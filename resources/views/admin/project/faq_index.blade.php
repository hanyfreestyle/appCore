@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.confirm-massage/>

    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-9">
                <h1 class="def_h1_new">{!! print_h1($Project) !!}</h1>
            </div>
            @if($pageData['ViewType'] == 'List')
                <div class="col-3 dir_button">
                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.faq_create', $Project->id)}}"  type="add"  size="s" :tip="false" />
                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.More_Photos', $Project->id)}}" type="morePhoto" :tip="false" />
                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.edit', $Project->id)}}" type="back" />
                </div>
            @endif
            @if($pageData['ViewType'] == 'deleteList')
                <div class="col-3 dir_button">
                    <x-admin.form.action-button  url="{{route('project.faq_list', $Project->id)}}" type="back" />
                </div>
            @endif
        </div>
   </x-admin.hmtl.section>

 <x-admin.hmtl.section>
     <div class="card pb-3">
         <div class="card-header">
             <h3 class="card-title">Question</h3>
             @if($pageData['ViewType'] == 'List')
                 @if($Trashed > 0 )
                     @can('project_restore')
                         <a href="{{route('project.faq_SoftDelete',$Project->id)}}" class="btn btn-sm btn-danger float-left">{{ __('admin/def.delete_restor_view') }}</a>
                     @endcan
                 @endif
             @endif
         </div>

         @if(count($ProjectQuestion)>0)
             <div class="card-body">
                 <table class="table table-hover" >
                     <thead>
                     <tr>
                         <th class="TD_20">#</th>
                         <th class="TD_350">{{__('admin/form.faq_question_ar')}}</th>
                         <th class="TD_350">{{__('admin/form.faq_answer_ar')}}</th>

                         @if($pageData['ViewType'] == 'deleteList')
                             <x-admin.table.soft-delete />
                         @else
                             <th class="TD_350">{{__('admin/form.faq_question_en')}}</th>
                             <th class="TD_350">{{__('admin/form.faq_answer_en')}}</th>
                             <x-admin.table.action-but po="top" type="edit"/>
                             <x-admin.table.action-but po="top" type="delete"/>
                         @endif

                     </tr>
                     </thead>

                     <tbody>
                     @foreach($ProjectQuestion as $Question)
                         <tr>
                             <td>{{$Question->id}}</td>
                             <td>{{optional($Question->translate('ar'))->question}}</td>
                             <td>{{optional($Question->translate('ar'))->answer}}</td>

                             @if($pageData['ViewType'] == 'deleteList')
                                 <td>{{$Question->deleted_at}}</td>
                                 <td class="tc"><x-admin.form.action-button url="{{route('project.faq_restore',$Question->id)}}" type="restor" :tip="false" /></td>
                                 <td class="tc"><x-admin.form.action-button url="#" id="{{route('project.faq_force',$Question->id)}}" type="deleteSweet" :tip="false" /></td>
                             @else
                                 <td>{{optional($Question->translate('en'))->question}}</td>
                                 <td>{{optional($Question->translate('en'))->answer}}</td>
                                 @can('project_edit')
                                     <td class="tc"><x-admin.form.action-button url="{{route('project.faq_edit',$Question->id)}}" type="edit" :tip="true" /></td>
                                 @endcan
                                 @can('project_delete')
                                     <td class="tc"><x-admin.form.action-button url="#" id="{{route('project.faq_destroy',$Question->id)}}" :tip="true" type="deleteSweet"/></td>
                                 @endcan
                             @endif
                         </tr>
                     @endforeach
                     </tbody>
                 </table>
             </div>
         @else
             <div class="col-lg-12 pr-4 pl-4">
                 <x-admin.hmtl.alert-massage type="nodata" />
             </div>
         @endif
         <div class="d-flex justify-content-center">
             @if($ProjectQuestion instanceof \Illuminate\Pagination\AbstractPaginator)
                 {{ $ProjectQuestion->links() }}
             @endif
         </div>
     </div>
</x-admin.hmtl.section>
@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
@endpush

