<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\AdminMainController;
use App\Helpers\PDF;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class DashboardController extends AdminMainController{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function adminTest(){

    }



    public function testpdf(){
        $pdf = new PDF();
        $data = [
            'foo' => 'bar'
        ];
        $pdf->addArCustomFont();
        $pdf->addEnCustomFont();
        $pdf->loadView('pdf.test', $data);
        //$pdf->SetProtection(['copy', 'print'], 'user_pass', 'owner_pass');
        return $pdf->stream('document.pdf');
       // return $pdf->download("hany.pdf");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Home
    public function Dashboard(){
        $Lang =  LaravelLocalization::getCurrentLocale() ;


        return view('admin.dashbord');
    }







}
