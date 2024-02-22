<?php


use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\ProjectToUnitsController;
use App\Http\Controllers\admin\QuestionController;
use App\Http\Controllers\admin\ForSaleController;
use Illuminate\Support\Facades\Route;

Route::get('/project',[ProjectController::class,'index'])->name('project.index');
Route::get('/project/DataTable',[ProjectController::class,'DataTable'])->name('project.DataTable');
Route::get('/project/create',[ProjectController::class,'create'])->name('project.create');
Route::get('/project/create/ar',[ProjectController::class,'create'])->name('project.create_ar');
Route::get('/project/create/en',[ProjectController::class,'create'])->name('project.create_en');
Route::get('/project/edit/{id}',[ProjectController::class,'edit'])->name('project.edit');
Route::get('/project/editAr/{id}',[ProjectController::class,'edit'])->name('project.editAr');
Route::get('/project/editEn/{id}',[ProjectController::class,'edit'])->name('project.editEn');
Route::get('/project/emptyPhoto/{id}', [ProjectController::class,'emptyPhoto'])->name('project.emptyPhoto');
Route::get('/project/DeleteLang/{id}',[ProjectController::class,'DeleteLang'])->name('project.DeleteLang');
Route::post('/project/update/{id}',[ProjectController::class,'storeUpdate'])->name('project.update');
Route::get('/project/destroy/{id}',[ProjectController::class,'destroyException'])->name('project.destroy');
Route::get('/project/photos/{id}',[ProjectController::class,'ListMorePhoto'])->name('project.More_Photos');
Route::get('/project/oldphoto/{id}',[ProjectController::class,'ListOldPhoto'])->name('project.Old_Photos');
Route::post('/project/saveSort', [ProjectController::class,'sortPhotoSave'])->name('project.sortPhotoSave');
Route::post('/project/AddMore',[ProjectController::class,'AddMorePhotos'])->name('project.More_PhotosAdd');
Route::get('/project/PhotoDel/{id}',[ProjectController::class,'More_PhotosDestroy'])->name('project.More_PhotosDestroy');
Route::get('/project/config', [ProjectController::class,'config'])->name('project.config');
Route::get('/project/noPhoto',[ProjectController::class,'CheckData'])->name('project.noPhoto');
Route::get('/project/noEn',[ProjectController::class,'CheckData'])->name('project.noEn');
Route::get('/project/noAr',[ProjectController::class,'CheckData'])->name('project.noAr');
Route::get('/project/unActive',[ProjectController::class,'CheckData'])->name('project.unActive');

Route::get('/project/faqlist/{id}',[QuestionController::class,'FaqList'])->name('project.faq_list');
Route::get('/project/FaqSoftDelete/{id}',[QuestionController::class,'FaqSoftDeletes'])->name('project.faq_SoftDelete');
Route::get('/project/faqrestore/{id}',[QuestionController::class,'FaqRestore'])->name('project.faq_restore');
Route::get('/project/faqforce/{id}',[QuestionController::class,'FaqForceDeletes'])->name('project.faq_force');
Route::get('/project/faq/create/{project_id}',[QuestionController::class,'FaqCreate'])->name('project.faq_create');
Route::get('/project/faq/edit/{id}',[QuestionController::class,'Faqedit'])->name('project.faq_edit');
Route::post('/project/faq/update/{id}',[QuestionController::class,'FaqstoreUpdate'])->name('project.faq_update');
Route::get('/project/faq/destroy/{id}',[QuestionController::class,'Faqdestroy'])->name('project.faq_destroy');





Route::get('/ProjectUnits/{projectId}',[ProjectToUnitsController::class,'index'])->name('project.ProjectUnits.index');


Route::get('/ProjectUnits/{projectId}/create/',[ProjectToUnitsController::class,'create'])->name('project.ProjectUnits.create');
Route::get('/ProjectUnits/{projectId}/create/ar/',[ProjectToUnitsController::class,'create'])->name('project.ProjectUnits.create_ar');
Route::get('/ProjectUnits/{projectId}/create/en/',[ProjectToUnitsController::class,'create'])->name('project.ProjectUnits.create_en');

Route::get('/ProjectUnits/{projectId}/edit/{id}',[ProjectToUnitsController::class,'edit'])->name('project.ProjectUnits.edit');
Route::get('/ProjectUnits/{projectId}/editAr/{id}',[ProjectToUnitsController::class,'edit'])->name('project.ProjectUnits.editAr');
Route::get('/ProjectUnits/{projectId}/editEn/{id}',[ProjectToUnitsController::class,'edit'])->name('project.ProjectUnits.editEn');
Route::get('/ProjectUnits/emptyPhoto/{id}', [ProjectToUnitsController::class,'emptyPhoto'])->name('project.ProjectUnits.emptyPhoto');
Route::get('/ProjectUnits/DeleteLang/{id}',[ProjectToUnitsController::class,'DeleteLang'])->name('project.ProjectUnits.DeleteLang');

Route::post('/ProjectUnits/update/{id}',[ProjectToUnitsController::class,'storeUpdate'])->name('project.ProjectUnits.update');
Route::get('/ProjectUnits/destroy/{id}',[ProjectToUnitsController::class,'destroy'])->name('project.ProjectUnits.destroy');
Route::get('/ProjectUnits/SoftDelete/{projectId}',[ProjectToUnitsController::class,'SoftDeletes'])->name('project.ProjectUnits.SoftDelete');
Route::get('/ProjectUnits/restore/{id}',[ProjectToUnitsController::class,'Restore'])->name('project.ProjectUnits.restore');
Route::get('/ProjectUnits/force/{id}',[ProjectToUnitsController::class,'destroyException'])->name('project.ProjectUnits.force');

Route::get('/ProjectUnits/{projectId}/photos/{id}',[ProjectToUnitsController::class,'ListMorePhoto'])->name('project.ProjectUnits.More_Photos');
Route::post('/ProjectUnits/saveSort', [ProjectToUnitsController::class,'sortPhotoSave'])->name('project.ProjectUnits.sortPhotoSave');
Route::post('/ProjectUnits/AddMore',[ProjectToUnitsController::class,'AddMorePhotos'])->name('project.ProjectUnits.More_PhotosAdd');
Route::get('/ProjectUnits/PhotoDel/{id}',[ProjectToUnitsController::class,'More_PhotosDestroy'])->name('project.ProjectUnits.More_PhotosDestroy');
Route::get('/ProjectUnits/{projectId}/oldphoto/{id}',[ProjectToUnitsController::class,'ListOldPhoto'])->name('project.ProjectUnits.Old_Photos');

Route::get('/projectUnit/{projectId}/config/', [ProjectToUnitsController::class,'config'])->name('project.ProjectUnits.config');
Route::get('/projectUnits/noPhoto/{projectId}',[ProjectToUnitsController::class,'CheckData'])->name('project.ProjectUnits.noPhoto');
Route::get('/projectUnits/noEn/{projectId}',[ProjectToUnitsController::class,'CheckData'])->name('project.ProjectUnits.noEn');
Route::get('/projectUnits/noAr/{projectId}',[ProjectToUnitsController::class,'CheckData'])->name('project.ProjectUnits.noAr');
Route::get('/projectUnits/unActive/{projectId}',[ProjectToUnitsController::class,'CheckData'])->name('project.ProjectUnits.unActive');


Route::get('/ForSale',[ForSaleController::class,'index'])->name('ForSale.index');
Route::get('/ForSale/DataTable',[ForSaleController::class,'DataTable'])->name('ForSale.DataTable');
Route::get('/ForSale/create',[ForSaleController::class,'create'])->name('ForSale.create');
Route::get('/ForSale/create/ar',[ForSaleController::class,'create'])->name('ForSale.create_ar');
Route::get('/ForSale/create/en',[ForSaleController::class,'create'])->name('ForSale.create_en');
Route::get('/ForSale/edit/{id}',[ForSaleController::class,'edit'])->name('ForSale.edit');
Route::get('/ForSale/editAr/{id}',[ForSaleController::class,'edit'])->name('ForSale.editAr');
Route::get('/ForSale/editEn/{id}',[ForSaleController::class,'edit'])->name('ForSale.editEn');
Route::get('/ForSale/emptyPhoto/{id}', [ForSaleController::class,'emptyPhoto'])->name('ForSale.emptyPhoto');
Route::get('/ForSale/DeleteLang/{id}',[ForSaleController::class,'DeleteLang'])->name('ForSale.DeleteLang');
Route::post('/ForSale/update/{id}',[ForSaleController::class,'storeUpdate'])->name('ForSale.update');
Route::get('/ForSale/destroy/{id}',[ForSaleController::class,'destroy'])->name('ForSale.destroy');

Route::get('/ForSale/SoftDelete/',[ForSaleController::class,'SoftDeletes'])->name('ForSale.SoftDelete');
Route::get('/ForSale/restore/{id}',[ForSaleController::class,'Restore'])->name('ForSale.restore');
Route::get('/ForSale/force/{id}',[ForSaleController::class,'destroyException'])->name('ForSale.force');
Route::get('/ForSale/photos/{id}',[ForSaleController::class,'ListMorePhoto'])->name('ForSale.More_Photos');
Route::post('/ForSale/saveSort', [ForSaleController::class,'sortPhotoSave'])->name('ForSale.sortPhotoSave');
Route::post('/ForSale/AddMore',[ForSaleController::class,'AddMorePhotos'])->name('ForSale.More_PhotosAdd');
Route::get('/ForSale/PhotoDel/{id}',[ForSaleController::class,'More_PhotosDestroy'])->name('ForSale.More_PhotosDestroy');
Route::get('/ForSale/oldphoto/{id}',[ForSaleController::class,'ListOldPhoto'])->name('ForSale.Old_Photos');

Route::get('/ForSale/config', [ForSaleController::class,'config'])->name('ForSale.config');
Route::get('/ForSale/noPhoto',[ForSaleController::class,'CheckData'])->name('ForSale.noPhoto');
Route::get('/ForSale/noEn',[ForSaleController::class,'CheckData'])->name('ForSale.noEn');
Route::get('/ForSale/noAr',[ForSaleController::class,'CheckData'])->name('ForSale.noAr');
Route::get('/ForSale/unActive',[ForSaleController::class,'CheckData'])->name('ForSale.unActive');
