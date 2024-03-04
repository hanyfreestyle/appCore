<?php

namespace App\AppPlugin\AppPuzzle;

use App\Helpers\AdminHelper;
use Illuminate\Support\Facades\File;


class AppPuzzleController {

    public $folderDate;
    public $mainFolder;

    function __construct() {
        $this->mainFolder = "D:\_AppPluginTest/";
        $this->mainFolder = "D:\_AppPlugin/";
        $this->folderDate = null;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   IndexModel
    public function IndexModel() {
        $rowData = AppPuzzleModelTree::ModelTree();
        return view('AppPlugin.AppPuzzle.index', compact('rowData'));
    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CopyModel
    public function CopyModel($model) {
        $modelTree = AppPuzzleModelTree::ModelTree();
        if(isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];

            self::CopyModelFile($thisModel,"infoFile");
            self::CopyModelFile($thisModel,"appFolder");
            self::CopyModelFile($thisModel,"viewFolder");
            self::CopyModelFile($thisModel,"routeFile");
            self::CopyModelFile($thisModel,"migrations");
            self::CopyModelFile($thisModel,"seeder");
            self::CopyModelFile($thisModel,"adminLangFiles");
            self::CopyModelFile($thisModel,"webLangFiles");
            self::CopyModelFile($thisModel,"photoFolder");
            self::CopyModelFile($thisModel,"assetsFolder");
            self::CopyLivewire($thisModel);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RemoveModelFile
    public function CopyModelFile($thisModel, $type) {
        $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/' ;
        self::folderMakeDirectory($CopyFolder);

        switch ($type) {
            case "infoFile":
                $fileName = issetArr($thisModel,'infoFile',null);
                if( $fileName != null) {
                    $filePath = app_path('AppPlugin/AppPuzzle/Files/' . $fileName);
                    if(File::isFile($filePath)) {
                        File::copy($filePath, $CopyFolder . "/" . $fileName);
                    }
                }
                break;

            case "appFolder":
                $folderName = issetArr($thisModel,'appFolder',null);
                if($folderName != null) {
                    $thisDir = app_path("AppPlugin/" . $folderName);
                    if(File::isDirectory($thisDir)) {
                        $destinationFolder = $CopyFolder . 'app/AppPlugin/' . $folderName;
                        self::recursive_files_copy($thisDir, $destinationFolder);
                    }
                }
                break;

            case "viewFolder":
                $folderName = issetArr($thisModel,'viewFolder',null);
                if($folderName != null) {
                    $thisDir = resource_path("views/AppPlugin/" . $folderName);
                    if(File::isDirectory($thisDir)) {
                        $destinationFolder = $CopyFolder . '/resources/views/AppPlugin/' . $folderName . "/";
                        self::recursive_files_copy($thisDir, $destinationFolder);
                    }
                }
                break;

            case "routeFile":
                $fileName = issetArr($thisModel,'routeFile',null);
                $routeFolder = issetArr($thisModel,'routeFolder',null);
                if($fileName != null) {
                    $filePath = base_path('routes/AppPlugin/' . $routeFolder . $fileName);
                    if(File::isFile($filePath)) {
                        $destinationFolder = $CopyFolder . '/routes/AppPlugin/' . $routeFolder;
                        self::folderMakeDirectory($destinationFolder);
                        File::copy($filePath, $destinationFolder . $fileName);
                    }
                }
                break;

            case "migrations":
                $migrations = issetArr($thisModel,'migrations',null);
                if($migrations != null and is_array($migrations)) {
                    foreach ($migrations as $file) {
                        $filePath = base_path('database/migrations/' . $file);
                        if(File::isFile($filePath)) {
                            $destinationFolder = $CopyFolder . '/database/migrations/';
                            self::folderMakeDirectory($destinationFolder);
                            File::copy($filePath, $destinationFolder . $file);
                        }
                    }
                }
                break;

            case "seeder":
                $seeders = issetArr($thisModel,'seeder',null);
                if($seeders != null and is_array($seeders)) {
                    foreach ($seeders as $file) {
                        $filePath = public_path('db/' . $file);
                        if(File::isFile($filePath)) {
                            $destinationFolder = $CopyFolder . '/public/db/';
                            self::folderMakeDirectory($destinationFolder);
                            File::copy($filePath, $destinationFolder . $file);
                        }
                    }
                }
                break;

            case "adminLangFiles":
                $adminLangFiles = issetArr($thisModel,'adminLangFiles',null);
                $adminLangFolder = issetArr($thisModel,'adminLangFolder',null);
                if($adminLangFiles != null and is_array($adminLangFiles)) {
                    foreach ($adminLangFiles as $file){
                        foreach (config('app.admin_lang') as $key => $lang) {
                            $filePath = resource_path('lang/' . $key . '/' . $adminLangFolder . $file);
                            if(File::isFile($filePath)) {
                                $destinationFolder = $CopyFolder . 'resources/lang/' . $key . '/' . $adminLangFolder;
                                self::folderMakeDirectory($destinationFolder);
                                File::copy($filePath, $destinationFolder . $file);
                            }
                        }
                    }
                }
                break;

            case "webLangFiles":
                $webLangFiles = issetArr($thisModel,'webLangFiles',null);
                $webLangFolder = issetArr($thisModel,'webLangFolder',null);
                if($webLangFiles != null and is_array($webLangFiles)) {
                    foreach ($webLangFiles as $file){
                        foreach (config('app.web_lang') as $key => $lang) {
                            $filePath = resource_path('lang/' . $key . '/' . $webLangFolder . $file);
                            if(File::isFile($filePath)) {
                                $destinationFolder = $CopyFolder . 'resources/lang/' . $key . '/' . $webLangFolder;
                                self::folderMakeDirectory($destinationFolder);
                                File::copy($filePath, $destinationFolder . $file);
                            }
                        }
                    }
                }
                break;

            case "photoFolder":
                $photoFolder = issetArr($thisModel,'photoFolder',null);
                if($photoFolder != null and is_array($photoFolder)) {
                    foreach ($photoFolder as $folderName ){
                        $thisDir = public_path("images/" . $folderName);
                        if(File::isDirectory($thisDir)) {
                            $destinationFolder = $CopyFolder . 'public/images/' . $folderName;
                            self::recursive_files_copy($thisDir, $destinationFolder);
                        }
                    }
                }
                break;

            case "assetsFolder":
                $assetsFolder = issetArr($thisModel,'assetsFolder',null);
                if($assetsFolder != null and is_array($assetsFolder)) {
                    foreach ($assetsFolder as $folderName ){
                        $thisDir = public_path("assets/" . $folderName);
                        if(File::isDirectory($thisDir)) {
                            $destinationFolder = $CopyFolder . 'public/assets/' . $folderName;
                            self::recursive_files_copy($thisDir, $destinationFolder);
                        }
                    }
                }
                break;

                case "XXXr":
//                dd($photoFolder);
                break;

            default:
                dd('no');
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopyLivewire
    public function CopyLivewire($thisModel) {
        $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/';

        if(isset($thisModel['livewireClass']) and is_array($thisModel['livewireClass'])) {
            foreach ($thisModel['livewireClass'] as $folder => $file){
                $filePath = app_path('Http/Livewire/'.$folder.'/'.$file);
                if(File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . 'app/Http/Livewire/'.$folder."/";
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $file);
                }
            }
        }
        if(isset($thisModel['livewireView']) and is_array($thisModel['livewireView'])) {
            foreach ($thisModel['livewireView'] as $folder => $file){
                $filePath = resource_path('views/livewire/'.$folder.'/'.$file);
                if(File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . 'resources/views/livewire/'.$folder."/";
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $file);
                }
            }
        }
    }









#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # RemoveModel
    public function RemoveModel($model) {
        $modelTree = AppPuzzleModelTree::ModelTree();
        if(isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
//            self::RemoveModelFile($thisModel,'AppFolder');
//            self::RemoveModelFile($thisModel,'ViewFolder');
//            self::RemoveModelFile($thisModel,'RouteFile');
//            self::RemoveModelFile($thisModel,'Migrations');
//            self::RemoveModelFile($thisModel,'Seeder');
//            self::RemoveModelFile($thisModel,'adminLang');
        } else {

        }


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RemoveModelFile
    public function RemoveModelFile($thisModel, $type) {

        switch ($type) {
            case "AppFolder":
                if($thisModel['app'] != null) {
                    $appFolder = AdminHelper::arrIsset($thisModel, 'appFolder', null);
                    $thisDir = app_path("AppPlugin/" . $appFolder . $thisModel['app']);
                    if(File::isDirectory($thisDir)) {
                        File::deleteDirectory($thisDir);
                    }
                }
                break;

            case "ViewFolder":
                if($thisModel['view'] != null) {
                    $thisDir = resource_path("views/AppPlugin/" . $thisModel['view']);
                    if(File::isDirectory($thisDir)) {
                        File::deleteDirectory($thisDir);
                    }
                }
                break;

            case "RouteFile":
                if($thisModel['route'] != null) {
                    $fileName = $thisModel['route'];
                    $routeFolder = $thisModel['routeFolder'];
                    $filePath = base_path('routes/AppPlugin/' . $routeFolder . $fileName);
                    if(File::isFile($filePath)) {
                        File::delete($filePath);
                    }
                }
                break;

            case "Migrations":
                if($thisModel['migrations'] != null) {
                    foreach ($thisModel['migrations'] as $migrations) {
                        $filePath = base_path('database/migrations/' . $migrations);
                        if(File::isFile($filePath)) {
                            File::delete($filePath);
                        }
                    }
                }
                break;

            case "Seeder":
                if($thisModel['seeder'] != null) {
                    foreach ($thisModel['seeder'] as $seeder) {
                        $filePath = public_path('db/' . $seeder);
                        if(File::isFile($filePath)) {
                            File::delete($filePath);
                        }
                    }
                }
                break;

            case "adminLang":
                if(isset($thisModel['adminLang']) and $thisModel['adminLang'] != null) {
                    $adminLangFile = $thisModel['adminLangFile'];
                    $adminLangFolder = $thisModel['adminLang'];
                    foreach (config('app.web_lang') as $key => $lang) {
                        $filePath = resource_path('lang/' . $key . '/' . $adminLangFolder . $adminLangFile);
                        if(File::isFile($filePath)) {
                            File::delete($filePath);
                        }
                    }
                }

                break;

            default:
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   folderMakeDirectory
    public function folderMakeDirectory($destinationFolder) {
        if(!File::isDirectory($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0777, true, true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   recursive_files_copy
    public function recursive_files_copy($source_dir, $destination_dir) {
        // Open the source folder / directory
        $dir = opendir($source_dir);

        // Create a destination folder / directory if not exist
        if(!File::isDirectory($destination_dir)) {
            self::folderMakeDirectory($destination_dir);
        }
        // Loop through the files in source directory
        while ($file = readdir($dir)) {
            // Skip . and ..
            if(($file != '.') && ($file != '..')) {
                // Check if it's folder / directory or file
                if(is_dir($source_dir . '/' . $file)) {
                    // Recursively calling this function for sub directory
                    self::recursive_files_copy($source_dir . '/' . $file, $destination_dir . '/' . $file);
                } else {
                    // Copying the files
                    // copy($source_dir.'/'.$file, $destination_dir.'/'.$file);
                    File::copy($source_dir . '/' . $file, $destination_dir . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

}
