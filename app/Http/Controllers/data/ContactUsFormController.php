<?php
namespace App\Http\Controllers\data;

use App\Exports\ContactUsFormExport;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Models\data\ContactUsForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;


class ContactUsFormController extends AdminMainController{

    use CrudTraits;

    function __construct(ContactUsForm $model){
        parent::__construct();
        $this->controllerName = "LeadsFrom";
        $this->PrefixRole = 'leads';
        $this->selMenu = "";
        $this->PrefixCatRoute = "";
        $this->PageTitle =  __('admin/config/leadForm.app_menu');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;
        $this->model = $model ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'restore'=> 0 ,
            'AddAction'=> 0 ,
            'AddConfig'=> true ,
            'configArr'=> ["filterid"=>0,"datatable"=>0,'orderbyName'=>0,"orderbyDate"=>1],
            'PageListUrl'=>"#",
            'formName'=> "LeadsFrom" ,
        ];
        self::loadConstructData($sendArr);
        $this->middleware('permission:'.$this->PrefixRole.'_view', ['only' => ['indexAll']]);
        $this->middleware('permission:'.$this->PrefixRole.'_export', ['only' => ['Export']]);

        $CashCountryList = self::CashCountryList();
        View::share('CashCountryList', $CashCountryList);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   indexAll
    public function indexAll(Request $request){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        if( Route::currentRouteName() == 'LeadsFrom.ContactUs.index' or Route::currentRouteName() == 'LeadsFrom.ContactUs.filter'  ){
            $this->formName = "LeadsFromContactUs";
            View::share('formName', $this->formName );
            View::share('PrefixRoute', "LeadsFrom.ContactUs" );
            $requestType = '1';
        }elseif (Route::currentRouteName() == 'LeadsFrom.Request.index' or Route::currentRouteName() == 'LeadsFrom.Request.filter'){
            $this->formName = "LeadsFromRequestCall";
            View::share('formName', $this->formName );
            View::share('PrefixRoute', "LeadsFrom.Request" );
            $requestType = '2';
        }elseif (Route::currentRouteName() == 'LeadsFrom.Meeting.index' or Route::currentRouteName() == 'LeadsFrom.Meeting.filter'){
            $this->formName = "LeadsFromMeeting";
            View::share('formName', $this->formName );
            View::share('PrefixRoute', "LeadsFrom.Meeting" );
            $requestType = '3';
        }

        $session = self::getSessionData($request);

        if($session == null){
            $rowData = self::getSelectQuery(ContactUsForm::where('request_type',$requestType));
        }else{

            $rowData = self::getSelectQuery(self::FilterQ(ContactUsForm::where('request_type',$requestType),$session));
        }

        return view('admin.data.leads.index',compact('pageData','rowData','requestType'));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function Export(Request $request){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        return Excel::download(new ContactUsFormExport($request), 'users.xlsx');

    }










}


