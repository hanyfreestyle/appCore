<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\AdminMainController;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Post;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
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
       if(App::environment('production')){



       }else{
           $PostsCount =[];
           $DevelopersCount =[];
           $ProjectsCount =[];
           $ProjectUnitsCount =[];
           $ForSaleCount =[];
       }

        return view('admin.dashbord')->with(
            [
             'PostsCount'=>$PostsCount,
             'DevelopersCount'=>$DevelopersCount,
             'ProjectsCount'=>$ProjectsCount,
             'ProjectUnitsCount'=>$ProjectUnitsCount,
             'ForSaleCount'=>$ForSaleCount,
            ]
        );

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text
    public function Update(){
        Cache::forget('Dashboard_PostsCount_Cash');
        Cache::forget('Dashboard_DevelopersCount_Cash');
        Cache::forget('Dashboard_ProjectsCount_Cash');
        Cache::forget('Dashboard_ProjectUnitsCount_Cash');
        Cache::forget('Dashboard_ForSaleCount_Cash');
        return back();
    }




}
