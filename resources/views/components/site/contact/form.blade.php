<div class="bg-neutral-0 rounded-4 p-6 FormDiv SiteBoxShadow">
    <form action="{{route($defroute)}}" method="post" class="mainform" >
        @csrf
        <input type="hidden" name="request_type"  value="{{$requestType}}">


        <h2 class="">{{ $formTitle }}</h2>
        <div class="hr-dashed my-4"></div>


        <div class="row g-4">

            <x-admin.form.input name="name" value="{{old('name')}}" :colrow="$colrow"
                                label="{{__('web/contact.form_name')}}" :labelview="false" :placeholder="true" dir="ar"  />

            <x-admin.form.input-phone name="phone" value="{{old('phone')}}" label="{{__('web/contact.form_phone')}}" :colrow="$colrow" :labelview="false" />


            @if($formType == 'contact')
                <x-admin.form.input name="subject" value="{{old('subject')}}" colrow="col-lg-12 col-12"
                                    label="{{__('web/contact.form_subject')}}" :labelview="false" :placeholder="true" dir="ar"  />
            @else
                <input type="hidden" name="listing_id" value="{{$row->id}}" >
                <input type="hidden" name="project_id" value="{{$row->parent_id}}" >
            @endif

            @if($formType == 'meeting')
                <x-admin.form.select-arr  :send-arr="$DaysArr" name="meeting_day" label="{{__('web/contact.form_meeting_day')}}" :sendvalue="old('meeting_day')"   colrow="col-lg-6 " :labelview="false" />
                <x-admin.form.select-arr  :send-arr="$MeetingTime_Arr" name="meeting_time" label="{{__('web/contact.form_meeting_time')}}" :sendvalue="old('meeting_time')"   colrow="col-lg-6 " :labelview="false" />
            @endif


            <x-admin.form.textarea name="message" value="{{old('message')}}" label="{{__('web/contact.form_message')}}"  :labelview="false" :placeholder="true"/>

            <div class="col-12">
                <button  class="btn btn-primary send_but" type="submit">{{__('web/contact.form_send')}}</button>
            </div>

        </div>
    </form>
</div>
