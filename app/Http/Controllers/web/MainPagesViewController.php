<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\WebMainController;
use App\Http\Requests\data\ContactUsFormRequest;
use App\Http\Requests\data\ContactUsOnPageRequest;
use App\Models\data\ContactUsForm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class MainPagesViewController extends WebMainController{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(){
        $Meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($Meta,'page_index');

        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'HomePage' ;



        return view('web.index')->with(
            [
                'pageView'=>$pageView,
            ]
        );
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ContactUs(){
        $Meta = parent::getMeatByCatId('contact-us');
        parent::printSeoMeta($Meta,"page_ContactUs");
        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'Contact' ;
        return view('web.contact.us')->with(['pageView'=>$pageView]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ContactSaveForm
    public function ContactSaveForm(ContactUsFormRequest $request){
        $saveContactUs = new ContactUsForm();
        $saveContactUs->name = $request->input('name');
        $saveContactUs->phone = $request->input('phone');
        if($request->input('countryCode_phone') == 'eg'){
            $saveContactUs->full_number = "+2".$request->input('phone');
        }else{
            $saveContactUs->full_number = "+".$request->input('countryDialCode_phone').$request->input('phone');
        }
        $saveContactUs->country = strtoupper($request->input('countryCode_phone'));
        $saveContactUs->subject = $request->input('subject');
        $saveContactUs->message = $request->input('message');
        $saveContactUs->request_type = $request->input('request_type');
        $saveContactUs->listing_id = $request->input('listing_id');
        $saveContactUs->project_id = $request->input('project_id');
        if( $request->input('request_type') == 3){
            $saveContactUs->meeting_day = Carbon::createFromTimestamp($request->input('meeting_day'))->toDateTimeString() ;
            $saveContactUs->meeting_time = $request->input('meeting_time');
        }
        $saveContactUs->save();

        Session::forget('RequestListing');
        return redirect()->route('ContactUsThanksPage');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ContactSaveFormOnPage(ContactUsOnPageRequest $request){
        $saveContactUs = new ContactUsForm();
        $formId = $request->input('form_id');
        $saveContactUs->name = $request->input('name'.$formId);
        $saveContactUs->phone = $request->input('phone'.$formId);
        if($request->input('countryCode_'.$formId) == 'eg'){
            $saveContactUs->full_number = "+2".$request->input('phone'.$formId);
        }else{
            $saveContactUs->full_number = "+".$request->input('countryDialCode_'.$formId).$request->input('phone'.$formId);
        }
        $saveContactUs->country = strtoupper($request->input('countryCode_'.$formId));
        $saveContactUs->request_type = $request->input('request_type');
        $saveContactUs->listing_id = $request->input('listing_id');
        $saveContactUs->project_id = $request->input('project_id');
        $saveContactUs->save();
        Session::forget('RequestListing');
        return redirect()->route('ContactUsThanksPage');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ContactUsThanksPage
    public function ContactUsThanksPage(){
        $Meta = parent::getMeatByCatId('contact-us');
        parent::printSeoMeta($Meta);
        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'Contact' ;
        return view('web.contact.thanks')->with(['pageView'=>$pageView]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RequestListing
    public function RequestListing($listid){
        Session::put('RequestListing',$listid);
        Session::save();
        return  redirect()->route('ContactUsRequestPage');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RequestListing
    public function MeetingRequest($listid){
        Session::put('RequestListing',$listid);
        Session::save();
        return  redirect()->route('MeetingRequestPage');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RequestListingView
    public function RequestListingView(){

        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'Contact' ;
        $Meta = parent::getMeatByCatId('contact-us');
        parent::printSeoMeta($Meta);


        $DaysArr = [];
        $thisDay = strtotime('today 00:00:00');
        for ($i = 1; $i <= 10 ; $i++) {
            if($i != 1){
                $thisDay = $thisDay+ 86400;
            }
            $Name =  Carbon::parse($thisDay)->locale(app()->getLocale())->translatedFormat('jS M Y');
            array_push($DaysArr, ['id'=>$thisDay,'name'=> $Name ]);

        }
        View::share('DaysArr', $DaysArr);

        if(intval(Session::get('RequestListing')) != 0){
            $listingId = intval(Session::get('RequestListing'));
            $unit = Listing::def()->where('id',$listingId)->first();
            if($unit != null){
                if(Route::currentRouteName() == 'MeetingRequestPage'){
                    $formType = 'meeting';
                }elseif (Route::currentRouteName() == 'ContactUsRequestPage' ){
                    $formType = 'request';
                }else{
                    $formType = '';
                }
                return view('web.contact.request')->with(['pageView'=>$pageView,'unit'=>$unit,'formType'=>$formType]);
            }
        }
        return view('web.contact.us')->with(['pageView'=>$pageView]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   UnderConstruction
    public function UnderConstruction(){
        $config = WebMainController::getWebConfig(0);
        if($config->web_status == 1 or Auth::check()){
            return redirect()->route('page_index');
        }
        $Meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($Meta);
        return view('under');
    }



}
