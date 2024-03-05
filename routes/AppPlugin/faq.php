<?php

use App\AppPlugin\Faq\FaqCategoryController;
use App\AppPlugin\Faq\FaqController;
use Illuminate\Support\Facades\Route;


Route::get('/FaqCategory',[FaqCategoryController::class,'CategoryIndex'])->name('Faq.FaqCategory.index');
Route::get('/FaqCategory/Main',[FaqCategoryController::class,'CategoryIndex'])->name('Faq.FaqCategory.index_Main');
Route::get('/FaqCategory/SubCategory/{id}',[FaqCategoryController::class,'CategoryIndex'])->name('Faq.FaqCategory.SubCategory');

Route::get('/FaqCategory/DataTable',[FaqCategoryController::class,'DataTable'])->name('Faq.FaqCategory.DataTable');
Route::get('/FaqCategory/create',[FaqCategoryController::class,'CategoryCreate'])->name('Faq.FaqCategory.create');
Route::get('/FaqCategory/create/ar',[FaqCategoryController::class,'CategoryCreate'])->name('Faq.FaqCategory.create_ar');
Route::get('/FaqCategory/create/en',[FaqCategoryController::class,'CategoryCreate'])->name('Faq.FaqCategory.create_en');
Route::get('/FaqCategory/edit/{id}',[FaqCategoryController::class,'CategoryEdit'])->name('Faq.FaqCategory.edit');
Route::get('/FaqCategory/editAr/{id}',[FaqCategoryController::class,'CategoryEdit'])->name('Faq.FaqCategory.editAr');
Route::get('/FaqCategory/editEn/{id}',[FaqCategoryController::class,'CategoryEdit'])->name('Faq.FaqCategory.editEn');
Route::get('/FaqCategory/emptyPhoto/{id}', [FaqCategoryController::class,'emptyPhoto'])->name('Faq.FaqCategory.emptyPhoto');
Route::get('/FaqCategory/DeleteLang/{id}',[FaqCategoryController::class,'DeleteLang'])->name('Faq.FaqCategory.DeleteLang');
Route::post('/FaqCategory/update/{id}',[FaqCategoryController::class,'CategoryStoreUpdate'])->name('Faq.FaqCategory.update');
Route::get('/FaqCategory/destroy/{id}',[FaqCategoryController::class,'destroyException'])->name('Faq.FaqCategory.destroy');
Route::get('/FaqCategory/config', [FaqCategoryController::class,'config'])->name('Faq.FaqCategory.config');
Route::get('/FaqCategory/emptyIcon/{id}', [FaqCategoryController::class,'emptyIcon'])->name('Faq.FaqCategory.emptyIcon');
Route::get('/FaqCategory/CatSort/{id}',[FaqCategoryController::class,'CategorySort'])->name('Faq.FaqCategory.CatSort');
Route::post('/FaqCategory/SaveSort',[FaqCategoryController::class,'CategorySaveSort'])->name('Faq.FaqCategory.SaveSort');



Route::get('/Faq',[FaqController::class,'index'])->name('Faq.Question.index');
Route::get('/Faq/Category/{Categoryid}',[FaqController::class,'ListCategory'])->name('Faq.Question.ListCategory');
Route::get('/Faq/SoftDelete/',[FaqController::class,'SoftDeletes'])->name('Faq.Question.SoftDelete');

Route::get('/Faq/create',[FaqController::class,'create'])->name('Faq.Question.create');
Route::get('/Faq/create/ar',[FaqController::class,'create'])->name('Faq.Question.create_ar');
Route::get('/Faq/create/en',[FaqController::class,'create'])->name('Faq.Question.create_en');
Route::get('/Faq/edit/{id}',[FaqController::class,'edit'])->name('Faq.Question.edit');
Route::get('/Faq/editAr/{id}',[FaqController::class,'edit'])->name('Faq.Question.editAr');
Route::get('/Faq/editEn/{id}',[FaqController::class,'edit'])->name('Faq.Question.editEn');
Route::post('/Faq/update/{id}',[FaqController::class,'storeUpdate'])->name('Faq.Question.update');

Route::get('/Faq/destroy/{id}',[FaqController::class,'destroy'])->name('Faq.Question.destroy');
Route::get('/Faq/restore/{id}',[FaqController::class,'Restore'])->name('Faq.Question.restore');
Route::get('/Faq/force/{id}',[FaqController::class,'ForceDeleteException'])->name('Faq.Question.force');
Route::get('/Faq/DeleteLang/{id}',[FaqController::class,'DeleteLang'])->name('Faq.Question.DeleteLang');
Route::get('/Faq/emptyPhoto/{id}', [FaqController::class,'emptyPhoto'])->name('Faq.Question.emptyPhoto');

Route::get('/Faq/photos/{id}',[FaqController::class,'ListMorePhoto'])->name('Faq.Question.More_Photos');
Route::post('/Faq/AddMore',[FaqController::class,'AddMorePhotos'])->name('Faq.Question.More_PhotosAdd');
Route::post('/Faq/saveSort', [FaqController::class,'sortPhotoSave'])->name('Faq.Question.sortPhotoSave');
Route::get('/Faq/PhotoDel/{id}',[FaqController::class,'More_PhotosDestroy'])->name('Faq.Question.More_PhotosDestroy');
Route::get('/Faq/config', [FaqController::class,'config'])->name('Faq.Question.config');