<?php

use App\AppPlugin\Product\ShopCategoryController;
use App\AppPlugin\Product\ShopProductController;
use Illuminate\Support\Facades\Route;


Route::get('/Category',[ShopCategoryController::class,'CategoryIndex'])->name('Shop.Category.index');
Route::get('/Category/Main',[ShopCategoryController::class,'CategoryIndex'])->name('Shop.Category.index_Main');
Route::get('/Category/SubCategory/{id}',[ShopCategoryController::class,'CategoryIndex'])->name('Shop.Category.SubCategory');

Route::get('/Category/DataTable',[ShopCategoryController::class,'DataTable'])->name('Shop.Category.DataTable');
Route::get('/Category/create',[ShopCategoryController::class,'CategoryCreate'])->name('Shop.Category.create');
Route::get('/Category/create/ar',[ShopCategoryController::class,'CategoryCreate'])->name('Shop.Category.create_ar');
Route::get('/Category/create/en',[ShopCategoryController::class,'CategoryCreate'])->name('Shop.Category.create_en');
Route::get('/Category/edit/{id}',[ShopCategoryController::class,'CategoryEdit'])->name('Shop.Category.edit');
Route::get('/Category/editAr/{id}',[ShopCategoryController::class,'CategoryEdit'])->name('Shop.Category.editAr');
Route::get('/Category/editEn/{id}',[ShopCategoryController::class,'CategoryEdit'])->name('Shop.Category.editEn');
Route::get('/Category/emptyPhoto/{id}', [ShopCategoryController::class,'emptyPhoto'])->name('Shop.Category.emptyPhoto');
Route::get('/Category/DeleteLang/{id}',[ShopCategoryController::class,'DeleteLang'])->name('Shop.Category.DeleteLang');
Route::post('/Category/update/{id}',[ShopCategoryController::class,'CategoryStoreUpdate'])->name('Shop.Category.update');
Route::get('/Category/destroy/{id}',[ShopCategoryController::class,'destroyException'])->name('Shop.Category.destroy');
Route::get('/Category/config', [ShopCategoryController::class,'config'])->name('Shop.Category.config');
Route::get('/Category/emptyIcon/{id}', [ShopCategoryController::class,'emptyIcon'])->name('Shop.Category.emptyIcon');
Route::get('/Category/CatSort/{id}',[ShopCategoryController::class,'CategorySort'])->name('Shop.Category.CatSort');
Route::post('/Category/SaveSort',[ShopCategoryController::class,'CategorySaveSort'])->name('Shop.Category.SaveSort');


//Route::get('/Category/photos/{id}',[ShopCategoryController::class,'ListMorePhoto'])->name('Shop.Category.More_Photos');
//Route::post('/Category/saveSort', [ShopCategoryController::class,'sortPhotoSave'])->name('Shop.Category.sortPhotoSave');
//Route::post('/Category/AddMore',[ShopCategoryController::class,'AddMorePhotos'])->name('Shop.Category.More_PhotosAdd');
//Route::get('/Category/PhotoDel/{id}',[ShopCategoryController::class,'More_PhotosDestroy'])->name('Shop.Category.More_PhotosDestroy');

Route::get('/Product',[ShopProductController::class,'index'])->name('Shop.Product.index');
Route::get('/Product/Category/{Categoryid}',[ShopProductController::class,'ListCategory'])->name('Shop.Product.ListCategory');

Route::get('/Product/create',[ShopProductController::class,'create'])->name('Shop.Product.create');
Route::get('/Product/create/ar',[ShopProductController::class,'create'])->name('Shop.Product.create_ar');
Route::get('/Product/create/en',[ShopProductController::class,'create'])->name('Shop.Product.create_en');
Route::get('/Product/edit/{id}',[ShopProductController::class,'edit'])->name('Shop.Product.edit');
Route::get('/Product/editAr/{id}',[ShopProductController::class,'edit'])->name('Shop.Product.editAr');
Route::get('/Product/editEn/{id}',[ShopProductController::class,'edit'])->name('Shop.Product.editEn');


Route::post('/Product/update/{id}',[ShopProductController::class,'storeUpdate'])->name('Shop.Product.update');
Route::get('/Product/photos/{id}',[ShopProductController::class,'ListMorePhoto'])->name('Shop.Product.More_Photos');
Route::get('/Product/destroy/{id}',[ShopProductController::class,'destroy'])->name('Shop.Product.destroy');
Route::get('/Product/emptyPhoto/{id}', [ShopProductController::class,'emptyPhoto'])->name('Shop.Product.emptyPhoto');
Route::post('/Product/AddMore',[ShopProductController::class,'AddMorePhotos'])->name('Shop.Product.More_PhotosAdd');
Route::post('/Product/saveSort', [ShopProductController::class,'sortPhotoSave'])->name('Shop.Product.sortPhotoSave');
Route::get('/Product/PhotoDel/{id}',[ShopProductController::class,'More_PhotosDestroy'])->name('Shop.Product.More_PhotosDestroy');
Route::get('/Product/SoftDelete/',[ShopProductController::class,'SoftDeletes'])->name('Shop.Product.SoftDelete');
Route::get('/Product/restore/{id}',[ShopProductController::class,'Restore'])->name('Shop.Product.restore');
Route::get('/Product/force/{id}',[ShopProductController::class,'ForceDeletesDDDDDDDDD'])->name('Shop.Product.force');

Route::get('/Product/config', [ShopProductController::class,'config'])->name('Shop.Product.config');