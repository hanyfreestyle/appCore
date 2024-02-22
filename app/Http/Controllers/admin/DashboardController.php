<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\AdminMainController;
use App\Helpers\PDF;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class DashboardController extends AdminMainController{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function adminTest($model){

        $modelTree = [
            'ConfigMeta'=>[
                'app'=>'ConfigMeta'

            ],
        ];
        $thisModel = $modelTree[$model];



        if($thisModel['app'] != null ){
            $thisDir = app_path("AppPlugin/".$thisModel['app']);

            if(File::isDirectory($thisDir)){
                $filesList = File::files($thisDir);

                $destinationFolder =  self::createAppFolder($thisModel['app']);

                foreach ($filesList as $file){
                    $fileB = $file->getRealPath();
                    $getBasename = $file->getBasename() ;
                   // $destination = public_path("AppPlugin/".$getBasename);
                    $destination = 'D:\_AppTest/'.$getBasename ;
                    File::copy($fileB,$destination);
                }
            }

        }


    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function createAppFolder($folderName){
        dd(time());
        $fullPath = 'D:\_AppTest/'.$folderName.'/20240225/app/AppPlugin/'.$folderName;


        if(!File::isDirectory($fullPath)){
            mkdir($fullPath, 0777, true);
             File::makeDirectory($fullPath, 0777, true, true);
        }

        return $fullPath ;
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
