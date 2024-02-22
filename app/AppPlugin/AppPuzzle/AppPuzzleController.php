<?php

namespace App\AppPlugin\AppPuzzle;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\select;

class AppPuzzleController{

    public $folderDate;
    public $mainFolder;

    function __construct(

    )
    {
        $this->mainFolder =  "D:\_AppTest/";

//        $this->folderDate = date("Y-m-d@his");
        $this->folderDate = date("Y-m-d");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ModelTree
    public function ModelTree(){
        $modelTree = [
            'ConfigMeta'=>[
                'app'=>'ConfigMeta',
                'view'=>'ConfigMeta',
                'routeFolder'=> "config/",
                'route'=>'configMeta.php',
                'migrations'=> ['2019_12_14_000003_create_meta_tags_table.php','2019_12_14_000004_create_meta_tag_translations_table.php'],
                'seeder'=> ['config_meta_tags.sql','config_setting_translations.sql'],

            ],
        ];

        return  $modelTree ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CopyModel
    public function CopyModel($model){
        $modelTree = self::ModelTree();

        $thisModel = $modelTree[$model];

        self::CopyAppFolder($thisModel);
        self::CopyViewFolder($thisModel);
        self::CopyRouteFile($thisModel);
        self::CopyMigrations($thisModel);
        self::CopySeeder($thisModel);

    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopySeeder
    public function CopySeeder($thisModel){
        $folderName = $thisModel['app'] ;
        if($thisModel['seeder'] != null ){
            foreach ($thisModel['seeder'] as $seeder){
                $filePath = public_path('db/'.$seeder);
                if(File::isFile($filePath)){
                    $destinationFolder = $this->mainFolder.$folderName.'/'.$this->folderDate.'/public/db/';
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath,$destinationFolder.$seeder);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopyMigrations
    public function CopyMigrations($thisModel){
        $folderName = $thisModel['app'] ;
        if($thisModel['migrations'] != null ){
            foreach ($thisModel['migrations'] as $migrations){
                $filePath = base_path('database/migrations/'.$migrations);
                if(File::isFile($filePath)){
                    $destinationFolder = $this->mainFolder.$folderName.'/'.$this->folderDate.'/database/migrations/';
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath,$destinationFolder.$migrations);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopyRouteFile
    public function CopyRouteFile($thisModel){
        if($thisModel['route'] != null ){
            $folderName = $thisModel['app'] ;
            $fileName = $thisModel['route'] ;
            $routeFolder = $thisModel['routeFolder'] ;
            $filePath = base_path('routes/AppPlugin/'.$routeFolder.$fileName);

            if(File::isFile($filePath)){
                $destinationFolder = $this->mainFolder.$folderName.'/'.$this->folderDate.'/routes/AppPlugin/'.$routeFolder;
                self::folderMakeDirectory($destinationFolder);
                File::copy($filePath,$destinationFolder.$fileName);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CopyViewFolder
    public function CopyViewFolder($thisModel){
        if($thisModel['view'] != null ){
            $folderName = $thisModel['view'] ;
            $thisDir = resource_path("views/AppPlugin/".$thisModel['view']);
            if(File::isDirectory($thisDir)){
                $filesList = File::files($thisDir);
                $destinationFolder = $this->mainFolder.$folderName.'/'.$this->folderDate.'/resources/views/AppPlugin/'.$folderName."/";
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
#|||||||||||||||||||||||||||||||||||||| #   CopyAppFolder
    public function CopyAppFolder($thisModel){
        if($thisModel['app'] != null ){
            $folderName = $thisModel['app'] ;
            $thisDir = app_path("AppPlugin/".$thisModel['app']);

            if(File::isDirectory($thisDir)){
                $filesList = File::files($thisDir);
                $destinationFolder = $this->mainFolder.$folderName.'/'.$this->folderDate.'/app/AppPlugin/'.$folderName."/";
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
#|||||||||||||||||||||||||||||||||||||| #
    public function folderMakeDirectory($destinationFolder){
        if(!File::isDirectory($destinationFolder)){
            File::makeDirectory($destinationFolder, 0777, true, true);
        }
    }


}
