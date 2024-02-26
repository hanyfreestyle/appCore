<?php

namespace App\AppPlugin\AppPuzzle;

use App\Helpers\AdminHelper;
use Illuminate\Support\Facades\File;


class AppPuzzleController {

    public $folderDate;
    public $mainFolder;

    function __construct() {
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
            self::CopyAppFolder($thisModel);
            self::CopyViewFolder($thisModel);
            self::CopyRouteFile($thisModel);
            self::CopyMigrations($thisModel);
            self::CopySeeder($thisModel);
            self::CopyAdminLang($thisModel);
            self::CopyInfo($thisModel);
            self::CopyPhotoFolder($thisModel);
            return redirect()->back();
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CopyViewFolder
    public function CopyPhotoFolder($thisModel) {
        if(isset($thisModel['photoFolder']) and $thisModel['photoFolder'] != null) {
            $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/' . $this->folderDate;
            $folderName = $thisModel['photoFolder'];
            $thisDir = public_path("images/" . $folderName);
            if(File::isDirectory($thisDir)) {
                $destinationFolder = $CopyFolder . 'public/images/' . $folderName;
                self::recursive_files_copy($thisDir, $destinationFolder);
            }
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
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
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopyAdminLang
    public function CopyAdminLang($thisModel) {
        if(isset($thisModel['adminLang']) and $thisModel['adminLang'] != null) {
            $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/' . $this->folderDate;
            $adminLangFile = $thisModel['adminLangFile'];
            $adminLangFolder = $thisModel['adminLang'];
            foreach (config('app.web_lang') as $key => $lang) {
                $filePath = resource_path('lang/' . $key . '/' . $adminLangFolder . $adminLangFile);
                if(File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . '/resources/lang/' . $key . '/' . $adminLangFolder;
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $adminLangFile);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CopyAppFolder
    public function CopyAppFolder($thisModel) {
        if(isset($thisModel['app']) and $thisModel['app'] != null) {
            $appFolder = AdminHelper::arrIsset($thisModel, 'appFolder', null);
            $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/' . $this->folderDate;
            $folderName = $thisModel['app'];
            $thisDir = app_path("AppPlugin/" . $appFolder . $folderName);
            if(File::isDirectory($thisDir)) {
                $filesList = File::files($thisDir);
                $destinationFolder = $CopyFolder . '/app/AppPlugin/' . $appFolder . $folderName . "/";
                self::folderMakeDirectory($destinationFolder);
                foreach ($filesList as $file) {
                    $fileB = $file->getRealPath();
                    $getBasename = $file->getBasename();
                    $destination = $destinationFolder . $getBasename;
                    File::copy($fileB, $destination);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CopyViewFolder
    public function CopyViewFolder($thisModel) {
        if(isset($thisModel['view']) and $thisModel['view'] != null) {
            $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/' . $this->folderDate;
            $folderName = $thisModel['view'];
            $thisDir = resource_path("views/AppPlugin/" . $folderName);
            if(File::isDirectory($thisDir)) {
                $filesList = File::files($thisDir);
                $destinationFolder = $CopyFolder . '/resources/views/AppPlugin/' . $folderName . "/";
                self::folderMakeDirectory($destinationFolder);
                foreach ($filesList as $file) {
                    $fileB = $file->getRealPath();
                    $getBasename = $file->getBasename();
                    $destination = $destinationFolder . $getBasename;
                    File::copy($fileB, $destination);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopyRouteFile
    public function CopyRouteFile($thisModel) {
        if(isset($thisModel['route']) and $thisModel['route'] != null) {
            $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/' . $this->folderDate;
            $fileName = $thisModel['route'];
            $routeFolder = $thisModel['routeFolder'];
            $filePath = base_path('routes/AppPlugin/' . $routeFolder . $fileName);
            if(File::isFile($filePath)) {
                $destinationFolder = $CopyFolder . '/routes/AppPlugin/' . $routeFolder;
                self::folderMakeDirectory($destinationFolder);
                File::copy($filePath, $destinationFolder . $fileName);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopyMigrations
    public function CopyMigrations($thisModel) {
        if(isset($thisModel['migrations']) and $thisModel['migrations'] != null) {
            $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/' . $this->folderDate;
            foreach ($thisModel['migrations'] as $migrations) {
                $filePath = base_path('database/migrations/' . $migrations);
                if(File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . '/database/migrations/';
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $migrations);
                }
            }
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CopySeeder
    public function CopySeeder($thisModel) {
        if(isset($thisModel['seeder']) and $thisModel['seeder'] != null) {
            $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/' . $this->folderDate;
            foreach ($thisModel['seeder'] as $seeder) {
                $filePath = public_path('db/' . $seeder);
                if(File::isFile($filePath)) {
                    $destinationFolder = $CopyFolder . '/public/db/';
                    self::folderMakeDirectory($destinationFolder);
                    File::copy($filePath, $destinationFolder . $seeder);
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CopInfo
    public function CopyInfo($thisModel) {
        if(isset($thisModel['info']) and $thisModel['info'] != null) {
            $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/' . $this->folderDate;
            $fileName = $thisModel['info'];
            $filePath = app_path('AppPlugin/AppPuzzle/Files/' . $fileName);
            if(File::isFile($filePath)) {
                $destinationFolder = $CopyFolder;
                self::folderMakeDirectory($destinationFolder);
                File::copy($filePath, $destinationFolder . "/" . $fileName);
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
#|||||||||||||||||||||||||||||||||||||| #
    public function folderMakeDirectory($destinationFolder) {
        if(!File::isDirectory($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0777, true, true);
        }
    }


}
