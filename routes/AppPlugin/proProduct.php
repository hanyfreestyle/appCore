<?php

use App\AppPlugin\Product\ShopCategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/Category',[ShopCategoryController::class,'index'])->name('Shop.Category.index');
Route::get('/Category/Main',[ShopCategoryController::class,'index'])->name('Shop.Category.index_Main');
Route::get('/Category/SubCategory/{id}',[ShopCategoryController::class,'index'])->name('Shop.Category.SubCategory');
Route::get('/Category/DataTable',[ShopCategoryController::class,'DataTable'])->name('Shop.Category.DataTable');
Route::get('/Category/create',[ShopCategoryController::class,'create'])->name('Shop.Category.create');
Route::get('/Category/create/ar',[ShopCategoryController::class,'create'])->name('Shop.Category.create_ar');
Route::get('/Category/create/en',[ShopCategoryController::class,'create'])->name('Shop.Category.create_en');
Route::get('/Category/edit/{id}',[ShopCategoryController::class,'edit'])->name('Shop.Category.edit');
Route::get('/Category/editAr/{id}',[ShopCategoryController::class,'edit'])->name('Shop.Category.editAr');
Route::get('/Category/editEn/{id}',[ShopCategoryController::class,'edit'])->name('Shop.Category.editEn');
Route::get('/Category/emptyPhoto/{id}', [ShopCategoryController::class,'emptyPhoto'])->name('Shop.Category.emptyPhoto');
Route::get('/Category/DeleteLang/{id}',[ShopCategoryController::class,'DeleteLang'])->name('Shop.Category.DeleteLang');
Route::post('/Category/update/{id}',[ShopCategoryController::class,'storeUpdate'])->name('Shop.Category.update');
Route::get('/Category/destroy/{id}',[ShopCategoryController::class,'destroyException'])->name('Shop.Category.destroy');
Route::get('/Category/config', [ShopCategoryController::class,'config'])->name('Shop.Category.config');
Route::get('/Category/emptyIcon/{id}', [ShopCategoryController::class,'emptyIcon'])->name('Shop.Category.emptyIcon');



//Route::get('/Category/photos/{id}',[ShopCategoryController::class,'ListMorePhoto'])->name('Shop.Category.More_Photos');
//Route::post('/Category/saveSort', [ShopCategoryController::class,'sortPhotoSave'])->name('Shop.Category.sortPhotoSave');
//Route::post('/Category/AddMore',[ShopCategoryController::class,'AddMorePhotos'])->name('Shop.Category.More_PhotosAdd');
//Route::get('/Category/PhotoDel/{id}',[ShopCategoryController::class,'More_PhotosDestroy'])->name('Shop.Category.More_PhotosDestroy');
