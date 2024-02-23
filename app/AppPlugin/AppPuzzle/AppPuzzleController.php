<?php

namespace App\AppPlugin\AppPuzzle;

use App\Helpers\AdminHelper;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\select;

class AppPuzzleController{

    public $folderDate;
    public $mainFolder;

    function __construct(

    )
    {
        $this->mainFolder =  "D:\_AppPlugin/";

//        $this->folderDate = date("Y-m-d@his");
        $this->folderDate = date("Y-m-d");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ModelTree
    public function ModelTree(){
        $modelTree = [
            'ConfigMeta'=>[
                'id'=>"ConfigMeta",
                'info'=>"ConfigMeta.txt",
                'CopyFolder'=>"ConfigMeta",
                'appFolder'=> "Config/",
                'app'=>'Meta',
                'view'=>'ConfigMeta',
                'routeFolder'=> "config/",
                'route'=>'configMeta.php',
                'migrations'=> ['2019_12_14_000003_create_meta_tags_table.php','2019_12_14_000004_create_meta_tag_translations_table.php'],
                'seeder'=> ['config_meta_tags.sql','config_setting_translations.sql'],
            ],

            'DataCountry'=>[
                'id'=>"DataCountry",
                'info'=>"DataCountry.txt",
                'CopyFolder'=>"DataCountry",
                'appFolder'=> "Data/",
                'app'=>'Country',
                'view'=>'DataCountry',
                'routeFolder'=> "data/",
                'route'=>'country.php',
                'migrations'=> ['2019_12_14_000014_create_countries_table.php','2019_12_14_000015_create_country_translations_table.php'],
                'seeder'=> ['data_countries.sql','data_country_translations.sql'],
            ],

        ];

        return  $modelTree ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   IndexModel
    public function IndexModel(){
        $rowData = self::ModelTree();
        return view('AppPlugin.AppPuzzle.index',compact('rowData'));
    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CopyModel
    public function CopyModel($model){
        $modelTree = self::ModelTree();

        if(isset($modelTree[$model])){
            $thisModel = $modelTree[$model];
            self::CopyAppFolder($thisModel);
            self::CopyViewFolder($thisModel);
            self::CopyRouteFile($thisModel);
            self::CopyMigrations($thisModel);
            self::CopySeeder($thisModel);
            self::CopInfo($thisModel);
            return redirect()->back();
        }


    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # RemoveModel
    public function RemoveModel($model){
        $modelTree = self::ModelTree();
        if(isset($modelTree[$model])){
            $thisModel = $modelTree[$model];

//        self::RemoveModelFile($thisModel,'AppFolder');
//        self::RemoveModelFile($thisModel,'ViewFolder');
//        self::RemoveModelFile($thisModel,'RouteFile');
//        self::RemoveModelFile($thisModel,'Migrations');
//        self::RemoveModelFile($thisModel,'Seeder');
        }else{

        }


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CopyAppFolder
    public function CopyAppFolder($thisModel){
        if(isset($thisModel['app']) and $thisModel['app'] != null ){
            $appFolder = AdminHelper::arrIsset($thisModel,'appFolder',null);
            $CopyFolder = $this->mainFolder.$thisModel['CopyFolder'].'/'.$this->folderDate ;
            $folderName = $thisModel['app'] ;
            $thisDir = app_path("AppPlugin/".$appFolder.$folderName);
            if(File::isDirectory($thisDir)){
                $filesList = File::files($thisDir);
                $destinationFolder = $CopyFolder.'/app/AppPlugin/'.$appFolder.$folderName."/";
                self::folderMakeDirectory($destinationFolder);
                foreach ($filesList as $file){
                    $fileB = $file->getRealPath();
                    $getBasename = $file->getBasename() ;
                    $destination = $destinationFolder.$getBasename ;
                    File::copy($fileB,$destination);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CopyViewFolder
    public function CopyViewFolder($thisModel){
        if(isset($thisModel['view']) and $thisModel['view'] != null ){
            $CopyFolder = $this->mainFolder.$thisModel['CopyFolder'].'/'.$this->folderDate ;
            $folderName = $thisModel['view'] ;
            $thisDir = resource_path("views/AppPlugin/".$folderName);
            if(File::isDirectory($thisDir)){
                $filesList = File::files($thisDir);
                $destinationFolder = $CopyFolder.'/resources/views/AppPlugin/'.$folderName."/";
                self::folderMakeDirectory($destinationFolder);
                foreach ($filesList as $file){
                    $fileB = $file->getRealPath();
                    $getBasename = $file->getBasename() ;
                    $destination = $destinationFolder.$getBasename ;
                    File::copy($fileB,$destination);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopyRouteFile
    public function CopyRouteFile($thisModel){
        if( isset($thisModel['route']) and $thisModel['route'] != null ){
            $CopyFolder = $this->mainFolder.$thisModel['CopyFolder'].'/'.$this->folderDate ;
            $fileName = $thisModel['route'] ;
            $routeFolder = $thisModel['routeFolder'] ;
            $filePath = base_path('routes/AppPlugin/'.$routeFolder.$fileName);
            if(File::isFile($filePath)){
                $destinationFolder = $CopyFolder.'/routes/AppPlugin/'.$routeFolder;
                self::folderMakeDirectory($destinationFolder);
                File::copy($filePath,$destinationFolder.$fileName);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopyMigrations
    public function CopyMigrations($thisModel){
        if(isset($thisModel['migrations']) and $thisModel['migrations'] != null ){
            $CopyFolder = $this->mainFolder.$thisModel['CopyFolder'].'/'.$this->folderDate ;
            foreach ($thisModel['migrations'] as $migrations){
                $filePath = base_path('database/migrations/'.$migrations);
                if(File::isFile($filePath)){
                    $destinationFolder = $CopyFolder.'/database/migrations/';
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath,$destinationFolder.$migrations);
                }
            }
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopySeeder
    public function CopySeeder($thisModel){
        if(isset($thisModel['seeder']) and $thisModel['seeder'] != null ){
            $CopyFolder = $this->mainFolder.$thisModel['CopyFolder'].'/'.$this->folderDate ;
            foreach ($thisModel['seeder'] as $seeder){
                $filePath = public_path('db/'.$seeder);
                if(File::isFile($filePath)){
                    $destinationFolder = $CopyFolder.'/public/db/';
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath,$destinationFolder.$seeder);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CopInfo
    public function CopInfo($thisModel){
        if(isset($thisModel['info']) and $thisModel['info'] != null ){
            $CopyFolder = $this->mainFolder.$thisModel['CopyFolder'].'/'.$this->folderDate ;
            $fileName = $thisModel['info'];
            $filePath = app_path('AppPlugin/AppPuzzle/Files/'.$fileName);
            if(File::isFile($filePath)){
                $destinationFolder = $CopyFolder;
                self::folderMakeDirectory($destinationFolder);
                File::copy($filePath,$destinationFolder."/".$fileName);
            }
        }
    }







#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RemoveModelFile
    public function RemoveModelFile($thisModel,$type){

        switch ($type) {
            case "AppFolder":
                if($thisModel['app'] != null ){
                    $thisDir = app_path("AppPlugin/".$thisModel['app']);
                    if(File::isDirectory($thisDir)){
                        File::deleteDirectory($thisDir);
                    }
                }
                break;

            case "ViewFolder":
                if($thisModel['view'] != null ){
                    $thisDir = resource_path("views/AppPlugin/".$thisModel['view']);
                    if(File::isDirectory($thisDir)){
                        File::deleteDirectory($thisDir);
                    }
                }
                break;

            case "RouteFile":
                if($thisModel['route'] != null ){
                    $fileName = $thisModel['route'] ;
                    $routeFolder = $thisModel['routeFolder'] ;
                    $filePath = base_path('routes/AppPlugin/'.$routeFolder.$fileName);
                    if(File::isFile($filePath)){
                        File::delete($filePath);
                    }
                }
                break;

            case "Migrations":
                if($thisModel['migrations'] != null ){
                    foreach ($thisModel['migrations'] as $migrations){
                        $filePath = base_path('database/migrations/'.$migrations);
                        if(File::isFile($filePath)){
                            File::delete($filePath);
                        }
                    }
                }
                break;

            case "Seeder":
                if($thisModel['seeder'] != null ){
                    foreach ($thisModel['seeder'] as $seeder){
                        $filePath = public_path('db/'.$seeder);
                        if(File::isFile($filePath)){
                            File::delete($filePath);
                        }
                    }
                }
                break;
            default:
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function folderMakeDirectory($destinationFolder){
        if(!File::isDirectory($destinationFolder)){
            File::makeDirectory($destinationFolder, 0777, true, true);
        }
    }



}
