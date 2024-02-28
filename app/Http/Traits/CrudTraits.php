<?php

namespace App\Http\Traits;

use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Requests\admin\MorePhotosRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait CrudTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id) {
        $deleteRow = $this->model->where('id', $id)->firstOrFail();
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Restore
    public function Restore($id) {
        $restore = $this->model->onlyTrashed()->where('id', $id)->firstOrFail();
        $restore->restore();
        self::ClearCash();
        return back()->with('restore', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDelete
    public function ForceDelete($id) {
        $deleteRow = $this->model->onlyTrashed()->where('id', $id)->firstOrFail();
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     emptyPhoto
    public function emptyPhoto($id) {
        $rowData = $this->model->where('id', $id)->firstOrFail();
        $rowData = AdminHelper::DeleteAllPhotos($rowData, true);
        $rowData->save();
        self::ClearCash();
        return back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     emptyPhoto
    public function emptyIcon($id) {
        $rowData = $this->model->where('id', $id)->firstOrFail();
        if(File::exists($rowData->icon)) {
            File::delete($rowData->icon);
        }
        $rowData->icon = null;
        $rowData->save();
        self::ClearCash();
        return back();
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     config
    public function config() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        if($this->configView) {
            return view($this->configView, compact('pageData'));
        } else {
            return view("admin.mainView.config", compact('pageData'));
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ListMorePhoto
    public function ListMorePhoto(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $id = $request->route()->parameter('id');
        $Model = $this->model->where('id', $id)->firstOrFail();
        $ListPhotos = $this->modelPhoto->where($this->modelPhotoColumn, $id)->orderBy('position')->get();
        return view('admin.mainView.photos', compact('ListPhotos', 'pageData', 'Model'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     AddMorePhotos
    public function AddMorePhotos(MorePhotosRequest $request) {
        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs($this->UploadDirIs . '/' . $request->input('model_id'));
        $saveImgData->setnewFileName($request->input('name'));
        $saveImgData->UploadMultiple($request);
        $modelPhotoColumn = $this->modelPhotoColumn;

        foreach ($saveImgData->sendSaveData as $newPhoto) {
            $saveData = $this->modelPhoto->findOrNew('0');
            $saveData->$modelPhotoColumn = $request->model_id;
            $saveData->photo = $newPhoto['photo']['file_name'];
            $saveData->photo_thum_1 = $newPhoto['photo_thum_1']['file_name'];
            $saveData->save();
        }
        self::ClearCash();
        return back()->with('Add.Done', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosDestroy
    public function More_PhotosDestroy($id) {
        $deleteRow = $this->modelPhoto->findOrFail($id);
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
    public function sortPhotoSave(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = $this->modelPhoto->findOrFail($id);
            $saveData->position = $newPosition;
            $saveData->save();
        }
        return response()->json(['success' => $positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ListOldPhoto
    public function ListOldPhoto(Request $request) {
        $pageData = $this->pageData;
        //dd($pageData);

        $pageData['ViewType'] = "Edit";
        $Project = Listing::findOrFail($request->route()->parameter('id'));
        $folderPath = public_path("ckfinder/userfiles/" . $Project->slider_images_dir);
        if(File::isDirectory($folderPath)) {
            $ProjectPhotos = File::files($folderPath);
        } else {
            $ProjectPhotos = [];
        }
        return view('admin.mainView.old_photos', compact('ProjectPhotos', 'pageData', 'Project'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {

    }

}
