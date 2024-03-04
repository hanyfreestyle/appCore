<?php

use App\AppPlugin\Faq\FaqCategoryController;
use App\AppPlugin\Product\ShopProductController;
use Illuminate\Support\Facades\Route;


Route::get('/FaqCategory',[FaqCategoryController::class,'CategoryIndex'])->name('Faq.Category.index');
Route::get('/FaqCategory/Main',[FaqCategoryController::class,'CategoryIndex'])->name('Faq.Category.index_Main');
Route::get('/FaqCategory/SubCategory/{id}',[FaqCategoryController::class,'CategoryIndex'])->name('Faq.Category.SubCategory');

Route::get('/FaqCategory/DataTable',[FaqCategoryController::class,'DataTable'])->name('Faq.Category.DataTable');
Route::get('/FaqCategory/create',[FaqCategoryController::class,'CategoryCreate'])->name('Faq.Category.create');
Route::get('/FaqCategory/create/ar',[FaqCategoryController::class,'CategoryCreate'])->name('Faq.Category.create_ar');
Route::get('/FaqCategory/create/en',[FaqCategoryController::class,'CategoryCreate'])->name('Faq.Category.create_en');
Route::get('/FaqCategory/edit/{id}',[FaqCategoryController::class,'CategoryEdit'])->name('Faq.Category.edit');
Route::get('/FaqCategory/editAr/{id}',[FaqCategoryController::class,'CategoryEdit'])->name('Faq.Category.editAr');
Route::get('/FaqCategory/editEn/{id}',[FaqCategoryController::class,'CategoryEdit'])->name('Faq.Category.editEn');
Route::get('/FaqCategory/emptyPhoto/{id}', [FaqCategoryController::class,'emptyPhoto'])->name('Faq.Category.emptyPhoto');
Route::get('/FaqCategory/DeleteLang/{id}',[FaqCategoryController::class,'DeleteLang'])->name('Faq.Category.DeleteLang');
Route::post('/FaqCategory/update/{id}',[FaqCategoryController::class,'CategoryStoreUpdate'])->name('Faq.Category.update');
Route::get('/FaqCategory/destroy/{id}',[FaqCategoryController::class,'destroyException'])->name('Faq.Category.destroy');
Route::get('/FaqCategory/config', [FaqCategoryController::class,'config'])->name('Faq.Category.config');
Route::get('/FaqCategory/emptyIcon/{id}', [FaqCategoryController::class,'emptyIcon'])->name('Faq.Category.emptyIcon');
Route::get('/FaqCategory/CatSort/{id}',[FaqCategoryController::class,'CategorySort'])->name('Faq.Category.CatSort');
Route::post('/FaqCategory/SaveSort',[FaqCategoryController::class,'CategorySaveSort'])->name('Faq.Category.SaveSort');



Route::get('/Faq',[ShopProductController::class,'index'])->name('Faq.Question.index');
Route::get('/Faq/Category/{Categoryid}',[ShopProductController::class,'ListCategory'])->name('Faq.Question.ListCategory');
Route::get('/Faq/SoftDelete/',[ShopProductController::class,'SoftDeletes'])->name('Faq.Question.SoftDelete');

Route::get('/Faq/create',[ShopProductController::class,'create'])->name('Faq.Question.create');
Route::get('/Faq/create/ar',[ShopProductController::class,'create'])->name('Faq.Question.create_ar');
Route::get('/Faq/create/en',[ShopProductController::class,'create'])->name('Faq.Question.create_en');
Route::get('/Faq/edit/{id}',[ShopProductController::class,'edit'])->name('Faq.Question.edit');
Route::get('/Faq/editAr/{id}',[ShopProductController::class,'edit'])->name('Faq.Question.editAr');
Route::get('/Faq/editEn/{id}',[ShopProductController::class,'edit'])->name('Faq.Question.editEn');
Route::post('/Faq/update/{id}',[ShopProductController::class,'storeUpdate'])->name('Faq.Question.update');

Route::get('/Faq/destroy/{id}',[ShopProductController::class,'destroy'])->name('Faq.Question.destroy');
Route::get('/Faq/restore/{id}',[ShopProductController::class,'Restore'])->name('Faq.Question.restore');
Route::get('/Faq/force/{id}',[ShopProductController::class,'ForceDeleteException'])->name('Faq.Question.force');
Route::get('/Faq/DeleteLang/{id}',[ShopProductController::class,'DeleteLang'])->name('Faq.Question.DeleteLang');
Route::get('/Faq/emptyPhoto/{id}', [ShopProductController::class,'emptyPhoto'])->name('Faq.Question.emptyPhoto');

Route::get('/Faq/photos/{id}',[ShopProductController::class,'ListMorePhoto'])->name('Faq.Question.More_Photos');
Route::post('/Faq/AddMore',[ShopProductController::class,'AddMorePhotos'])->name('Faq.Question.More_PhotosAdd');
Route::post('/Faq/saveSort', [ShopProductController::class,'sortPhotoSave'])->name('Faq.Question.sortPhotoSave');
Route::get('/Faq/PhotoDel/{id}',[ShopProductController::class,'More_PhotosDestroy'])->name('Faq.Question.More_PhotosDestroy');
Route::get('/Faq/config', [ShopProductController::class,'config'])->name('Faq.Question.config');