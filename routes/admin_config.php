<?php

use App\AppPlugin\ConfigMeta\MetaTagController;
use App\Http\Controllers\admin\config\DefPhotoController;
use App\Http\Controllers\admin\config\LangFileController;
use App\Http\Controllers\admin\config\LangFileWebController;
use App\Http\Controllers\admin\config\SettingsController;
use App\Http\Controllers\admin\config\UploadFilterController;
use App\Http\Controllers\admin\config\UploadFilterSizeController;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\Route;

Route::post('/config/update', [AdminMainController::class, 'ConfigModelUpdate'])->name('config.model.update');
Route::post('/ForgetSession', [AdminMainController::class, 'ForgetSession'])->name('admin.ForgetSession');

Route::get('/adminlang',[LangFileController::class,'index'])->name('adminlang.index');
Route::get('/adminlang/edit',[LangFileController::class,'EditLang'])->name('adminlang.edit');
Route::post('/adminlang/updateFile',[LangFileController::class,'updateFile'])->name('adminlang.updateFile');

Route::get('/weblang',[LangFileWebController::class,'index'])->name('weblang.index');
Route::get('/weblang/edit',[LangFileWebController::class,'EditLang'])->name('weblang.edit');
Route::post('/weblang/updateFile',[LangFileWebController::class,'updateFile'])->name('weblang.updateFile');

Route::get('/config/webConfig', [SettingsController::class, 'webConfigEdit'])->name('config.web.index');
Route::post('/config/webConfigUpdate', [SettingsController::class, 'webConfigUpdate'])->name('admin.webConfigUpdate');

Route::get('/metaTags', [MetaTagController::class,'index'])->name('config.Meta.index');
Route::get('/metaTags/create', [MetaTagController::class,'create'])->name('config.Meta.create');
Route::get('/metaTags/edit/{id}', [MetaTagController::class,'edit'])->name('config.Meta.edit');
Route::post('/metaTags/Update/{id}', [MetaTagController::class,'storeUpdate'])->name('config.Meta.update');
Route::get('/metaTags/delete/{id}', [MetaTagController::class,'destroy'])->name('config.Meta.destroy');
Route::get('/metaTags/config', [MetaTagController::class,'config'])->name('config.Meta.config');
Route::get('/metaTags/emptyPhoto/{id}', [MetaTagController::class,'emptyPhoto'])->name('config.Meta.emptyPhoto');
Route::get('/metaTags/SoftDelete/',[MetaTagController::class,'SoftDeletes'])->name('config.Meta.SoftDelete');
Route::get('/metaTags/restore/{id}',[MetaTagController::class,'Restore'])->name('config.Meta.restore');
Route::get('/metaTags/force/{id}',[MetaTagController::class,'ForceDelete'])->name('config.Meta.force');

Route::get('/defPhotos', [DefPhotoController::class,'index'])->name('config.defPhoto.index');
Route::get('/sortDefPhoto/ListAll', [DefPhotoController::class,'sortDefPhotoList'])->name('config.defPhoto.sortDefPhotoList');
Route::get('/defPhotos/create', [DefPhotoController::class,'create'])->name('config.defPhoto.create');
Route::get('/defPhotos/edit/{id}', [DefPhotoController::class,'edit'])->name('config.defPhoto.edit');
Route::get('/defPhotos/delete/{id}', [DefPhotoController::class,'destroy'])->name('config.defPhoto.destroy');
Route::post('/defPhotos/store/{id}', [DefPhotoController::class,'storeUpdate'])->name('config.defPhoto.storeUpdate');
Route::post('/sortDefPhoto/saveSort', [DefPhotoController::class,'sortDefPhotoSave'])->name('config.defPhoto.sortDefPhoto');

Route::get('/upFilter', [UploadFilterController::class,'index'])->name('config.upFilter.index');
Route::get('/upFilter/create', [UploadFilterController::class,'create'])->name('config.upFilter.create');
Route::get('/upFilter/edit/{id}', [UploadFilterController::class,'edit'])->name('config.upFilter.edit');
Route::get('/upFilter/delete/{id}', [UploadFilterController::class,'destroy'])->name('config.upFilter.destroy');
Route::post('/upFilter/Update/{id}', [UploadFilterController::class,'storeUpdate'])->name('config.upFilter.update');
Route::get('/upFilter/config', [UploadFilterController::class,'config'])->name('config.upFilter.config');
Route::get('/upFilter/SoftDelete/',[UploadFilterController::class,'SoftDeletes'])->name('config.upFilter.SoftDelete');
Route::get('/upFilter/restore/{id}',[UploadFilterController::class,'Restore'])->name('config.upFilter.restore');
Route::get('/upFilter/force/{id}',[UploadFilterController::class,'ForceDelete'])->name('config.upFilter.force');

Route::get('/upFilterSize/create/{filterId}', [UploadFilterSizeController::class,'create'])->name('config.upFilter.size.create');
Route::get('/upFilterSize/edit/{id}', [UploadFilterSizeController::class,'edit'])->name('config.upFilter.size.edit');
Route::get('/upFilterSize/delete/{id}', [UploadFilterSizeController::class,'destroy'])->name('config.upFilter.size.destroy');
Route::post('/upFilterSize/store/{id}', [UploadFilterSizeController::class,'storeUpdate'])->name('config.upFilter.size.storeOrUpdate');
Route::get('/clearCash/',[SettingsController::class,'clearCash'])->name('cash.index');
