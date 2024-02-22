<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\AmenityController;
use App\Http\Controllers\admin\DeveloperController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\PageAdminController;
use Illuminate\Support\Facades\Route;


Route::get('/',[DashboardController::class,'Dashboard'])->name('admin.Dashboard');
Route::get('/Home/Update',[DashboardController::class,'Update'])->name('admin.Dashboard.Update');
Route::get('/testpdf',[DashboardController::class,'testpdf'])->name('admin.testpdf');
Route::get('/adminTest',[DashboardController::class,'adminTest'])->name('admin.adminTest');

Route::get('/amenity',[AmenityController::class,'index'])->name('amenity.index');
Route::get('/amenity/create',[AmenityController::class,'create'])->name('amenity.create');
Route::post('/amenity/store/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.store');
Route::get('/amenity/edit/{id}',[AmenityController::class,'edit'])->name('amenity.edit');
Route::post('/amenity/update/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.update');
Route::get('/amenity/destroy/{id}',[AmenityController::class,'destroy'])->name('amenity.destroy');
Route::get('/amenity/emptyPhoto/{id}', [AmenityController::class,'emptyPhoto'])->name('amenity.emptyPhoto');
Route::get('/amenity/config', [AmenityController::class,'config'])->name('amenity.config');
Route::get('/amenity/SoftDelete/',[AmenityController::class,'SoftDeletes'])->name('amenity.SoftDelete');
Route::get('/amenity/restore/{id}',[AmenityController::class,'Restore'])->name('amenity.restore');
Route::get('/amenity/force/{id}',[AmenityController::class,'ForceDelete'])->name('amenity.force');


Route::get('/location',[LocationController::class,'index'])->name('location.index');
Route::get('/location/create',[LocationController::class,'create'])->name('location.create');
Route::post('/location/store/{id}',[LocationController::class,'storeUpdate'])->name('location.store');
Route::get('/location/edit/{id}',[LocationController::class,'edit'])->name('location.edit');
Route::get('/location/emptyPhoto/{id}', [LocationController::class,'emptyPhoto'])->name('location.emptyPhoto');
Route::post('/location/update/{id}',[LocationController::class,'storeUpdate'])->name('location.update');
Route::get('/location/destroy/{id}',[LocationController::class,'destroyException'])->name('location.destroy');
Route::get('/location/config', [LocationController::class,'config'])->name('location.config');


Route::get('/developer',[DeveloperController::class,'index'])->name('developer.index');
Route::get('/developer/DataTable',[DeveloperController::class,'DataTable'])->name('developer.DataTable');
Route::get('/developer/create',[DeveloperController::class,'create'])->name('developer.create');
Route::get('/developer/edit/{id}',[DeveloperController::class,'edit'])->name('developer.edit');
Route::get('/developer/emptyPhoto/{id}', [DeveloperController::class,'emptyPhoto'])->name('developer.emptyPhoto');
Route::post('/developer/update/{id}',[DeveloperController::class,'storeUpdate'])->name('developer.update');
Route::get('/developer/destroy/{id}',[DeveloperController::class,'destroyException'])->name('developer.destroy');
Route::get('/developer/photos/{id}',[DeveloperController::class,'ListMorePhoto'])->name('developer.More_Photos');
Route::post('/developer/saveSort', [DeveloperController::class,'sortPhotoSave'])->name('developer.sortPhotoSave');
Route::post('/developer/AddMore',[DeveloperController::class,'AddMorePhotos'])->name('developer.More_PhotosAdd');
Route::get('/developer/PhotoDel/{id}',[DeveloperController::class,'More_PhotosDestroy'])->name('developer.More_PhotosDestroy');
Route::get('/developer/config', [DeveloperController::class,'config'])->name('developer.config');

Route::get('/developer/noPhoto',[DeveloperController::class,'CheckData'])->name('developer.noPhoto');
Route::get('/developer/slugErr',[DeveloperController::class,'CheckData'])->name('developer.slugErr');
Route::get('/developer/noEn',[DeveloperController::class,'CheckData'])->name('developer.noEn');
Route::get('/developer/noAr',[DeveloperController::class,'CheckData'])->name('developer.noAr');
Route::get('/developer/unActive',[DeveloperController::class,'CheckData'])->name('developer.unActive');



Route::get('/Pages',[PageAdminController::class,'index'])->name('pages.index');
Route::get('/Pages/location/{id}',[PageAdminController::class,'index'])->name('pages.location_index');
Route::get('/Pages/compound/{id}',[PageAdminController::class,'index'])->name('pages.compound_index');
Route::get('/Pages/SoftDelete/',[PageAdminController::class,'SoftDeletes'])->name('pages.SoftDelete');
Route::get('/Pages/restore/{id}',[PageAdminController::class,'Restore'])->name('pages.restore');
Route::get('/Pages/force/{id}',[PageAdminController::class,'ForceDelete'])->name('pages.force');
Route::get('/Pages/create',[PageAdminController::class,'create'])->name('pages.create');
Route::get('/Pages/edit/{id}',[PageAdminController::class,'edit'])->name('pages.edit');
Route::post('/Pages/update/{id}',[PageAdminController::class,'storeUpdate'])->name('pages.update');
Route::get('/Pages/destroy/{id}',[PageAdminController::class,'destroy'])->name('pages.destroy');
Route::get('/Pages/config', [PageAdminController::class,'config'])->name('pages.config');
Route::get('/Pages/noEn',[PageAdminController::class,'CheckData'])->name('pages.noEn');
Route::get('/Pages/noAr',[PageAdminController::class,'CheckData'])->name('pages.noAr');
Route::get('/Pages/unActive',[PageAdminController::class,'CheckData'])->name('pages.unActive');



Route::get('/Category',[CategoryController::class,'index'])->name('Blog.category.index');
Route::get('/Category/create',[CategoryController::class,'create'])->name('Blog.category.create');
Route::get('/Category/edit/{id}',[CategoryController::class,'edit'])->name('Blog.category.edit');
Route::post('/Category/update/{id}',[CategoryController::class,'storeUpdate'])->name('Blog.category.update');
Route::get('/Category/destroy/{id}',[CategoryController::class,'destroyException'])->name('Blog.category.destroy');
Route::get('/Category/emptyPhoto/{id}', [CategoryController::class,'emptyPhoto'])->name('Blog.category.emptyPhoto');
Route::get('/Category/config', [CategoryController::class,'config'])->name('Blog.category.config');


Route::get('/post',[PostController::class,'index'])->name('Blog.post.index');
Route::get('/post/DataTable',[PostController::class,'DataTable'])->name('Blog.post.DataTable');
Route::get('/post/create',[PostController::class,'create'])->name('Blog.post.create');
Route::get('/post/create/ar',[PostController::class,'create'])->name('Blog.post.create_ar');
Route::get('/post/create/en',[PostController::class,'create'])->name('Blog.post.create_en');

Route::get('/post/edit/{id}',[PostController::class,'edit'])->name('Blog.post.edit');
Route::get('/post/destroy/{id}',[PostController::class,'destroy'])->name('Blog.post.destroy');
Route::get('/post/editAr/{id}',[PostController::class,'edit'])->name('Blog.post.editAr');
Route::get('/post/editEn/{id}',[PostController::class,'edit'])->name('Blog.post.editEn');
Route::post('/post/update/{id}',[PostController::class,'storeUpdate'])->name('Blog.post.update');
Route::get('/post/DeleteLang/{id}',[PostController::class,'DeleteLang'])->name('Blog.post.DeleteLang');

Route::get('/post/emptyPhoto/{id}', [PostController::class,'emptyPhoto'])->name('Blog.post.emptyPhoto');
Route::get('/post/SoftDelete/',[PostController::class,'SoftDeletes'])->name('Blog.post.SoftDelete');
Route::get('/post/restore/{id}',[PostController::class,'Restore'])->name('Blog.post.restore');
Route::get('/post/force/{id}',[PostController::class,'ForceDeletes'])->name('Blog.post.force');

Route::get('/post/photos/{id}',[PostController::class,'ListMorePhoto'])->name('Blog.post.More_Photos');
Route::post('/post/saveSort', [PostController::class,'sortPhotoSave'])->name('Blog.post.sortPhotoSave');
Route::post('/post/AddMore',[PostController::class,'AddMorePhotos'])->name('Blog.post.More_PhotosAdd');
Route::get('/post/PhotoDel/{id}',[PostController::class,'More_PhotosDestroy'])->name('Blog.post.More_PhotosDestroy');
Route::get('/post/config', [PostController::class,'config'])->name('Blog.post.config');

Route::get('/post/noPhoto',[PostController::class,'CheckData'])->name('Blog.post.noPhoto');
Route::get('/post/slugErr',[PostController::class,'CheckData'])->name('Blog.post.slugErr');
Route::get('/post/noEn',[PostController::class,'CheckData'])->name('Blog.post.noEn');
Route::get('/post/noAr',[PostController::class,'CheckData'])->name('Blog.post.noAr');
Route::get('/post/unActive',[PostController::class,'CheckData'])->name('Blog.post.unActive');

