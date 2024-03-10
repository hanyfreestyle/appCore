<?php

use App\AppPlugin\Product\ShopAttributeController;
use App\AppPlugin\Product\ShopBrandController;
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



Route::get('/Brand',[ShopBrandController::class,'CategoryIndex'])->name('Shop.Brand.index');
Route::get('/Brand/Main',[ShopBrandController::class,'CategoryIndex'])->name('Shop.Brand.index_Main');
Route::get('/Brand/SubCategory/{id}',[ShopBrandController::class,'CategoryIndex'])->name('Shop.Brand.SubCategory');

Route::get('/Brand/DataTable',[ShopBrandController::class,'DataTable'])->name('Shop.Brand.DataTable');
Route::get('/Brand/create',[ShopBrandController::class,'CategoryCreate'])->name('Shop.Brand.create');
Route::get('/Brand/create/ar',[ShopBrandController::class,'CategoryCreate'])->name('Shop.Brand.create_ar');
Route::get('/Brand/create/en',[ShopBrandController::class,'CategoryCreate'])->name('Shop.Brand.create_en');
Route::get('/Brand/edit/{id}',[ShopBrandController::class,'CategoryEdit'])->name('Shop.Brand.edit');
Route::get('/Brand/editAr/{id}',[ShopBrandController::class,'CategoryEdit'])->name('Shop.Brand.editAr');
Route::get('/Brand/editEn/{id}',[ShopBrandController::class,'CategoryEdit'])->name('Shop.Brand.editEn');
Route::get('/Brand/emptyPhoto/{id}', [ShopBrandController::class,'emptyPhoto'])->name('Shop.Brand.emptyPhoto');
Route::get('/Brand/DeleteLang/{id}',[ShopBrandController::class,'DeleteLang'])->name('Shop.Brand.DeleteLang');
Route::post('/Brand/update/{id}',[ShopBrandController::class,'CategoryStoreUpdate'])->name('Shop.Brand.update');
Route::get('/Brand/destroy/{id}',[ShopBrandController::class,'destroyException'])->name('Shop.Brand.destroy');
Route::get('/Brand/config', [ShopBrandController::class,'config'])->name('Shop.Brand.config');
Route::get('/Brand/emptyIcon/{id}', [ShopBrandController::class,'emptyIcon'])->name('Shop.Brand.emptyIcon');
Route::get('/Brand/CatSort/{id}',[ShopBrandController::class,'CategorySort'])->name('Shop.Brand.CatSort');
Route::post('/Brand/SaveSort',[ShopBrandController::class,'CategorySaveSort'])->name('Shop.Brand.SaveSort');


Route::get('/Product',[ShopProductController::class,'index'])->name('Shop.Product.index');
Route::get('/Product/Category/{Categoryid}',[ShopProductController::class,'ListCategory'])->name('Shop.Product.ListCategory');
Route::get('/Product/SoftDelete/',[ShopProductController::class,'SoftDeletes'])->name('Shop.Product.SoftDelete');

Route::get('/Product/create',[ShopProductController::class,'create'])->name('Shop.Product.create');
Route::get('/Product/create/ar',[ShopProductController::class,'create'])->name('Shop.Product.create_ar');
Route::get('/Product/create/en',[ShopProductController::class,'create'])->name('Shop.Product.create_en');
Route::get('/Product/edit/{id}',[ShopProductController::class,'edit'])->name('Shop.Product.edit');
Route::get('/Product/editAr/{id}',[ShopProductController::class,'edit'])->name('Shop.Product.editAr');
Route::get('/Product/editEn/{id}',[ShopProductController::class,'edit'])->name('Shop.Product.editEn');
Route::post('/Product/update/{id}',[ShopProductController::class,'storeUpdate'])->name('Shop.Product.update');

Route::get('/Product/destroy/{id}',[ShopProductController::class,'destroy'])->name('Shop.Product.destroy');
Route::get('/Product/restore/{id}',[ShopProductController::class,'Restore'])->name('Shop.Product.restore');
Route::get('/Product/force/{id}',[ShopProductController::class,'ForceDeleteException'])->name('Shop.Product.force');
Route::get('/Product/DeleteLang/{id}',[ShopProductController::class,'DeleteLang'])->name('Shop.Product.DeleteLang');
Route::get('/Product/emptyPhoto/{id}', [ShopProductController::class,'emptyPhoto'])->name('Shop.Product.emptyPhoto');

Route::get('/Product/photos/{id}',[ShopProductController::class,'ListMorePhoto'])->name('Shop.Product.More_Photos');
Route::post('/Product/AddMore',[ShopProductController::class,'AddMorePhotos'])->name('Shop.Product.More_PhotosAdd');
Route::post('/Product/saveSort', [ShopProductController::class,'sortPhotoSave'])->name('Shop.Product.sortPhotoSave');
Route::get('/Product/PhotoDel/{id}',[ShopProductController::class,'More_PhotosDestroy'])->name('Shop.Product.More_PhotosDestroy');
Route::get('/Product/config', [ShopProductController::class,'config'])->name('Shop.Product.config');



Route::get('/ProAttribute',[ShopAttributeController::class,'index'])->name('Shop.ProAttribute.index');
Route::get('/ProAttribute/create',[ShopAttributeController::class,'create'])->name('Shop.ProAttribute.create');
Route::get('/ProAttribute/edit/{id}',[ShopAttributeController::class,'edit'])->name('Shop.ProAttribute.edit');
Route::post('/ProAttribute/update/{id}',[ShopAttributeController::class,'storeUpdate'])->name('Shop.ProAttribute.update');
Route::get('/ProAttribute/destroy/{id}',[ShopAttributeController::class,'ForceDeleteException'])->name('Shop.ProAttribute.destroy');
Route::get('/ProAttribute/Sort',[ShopAttributeController::class,'Sort'])->name('Shop.ProAttribute.Sort');
Route::post('/ProAttribute/SaveSort',[ShopAttributeController::class,'SaveSort'])->name('Shop.ProAttribute.SaveSort');
Route::get('/ProAttribute/config', [ShopAttributeController::class,'config'])->name('Shop.ProAttribute.config');