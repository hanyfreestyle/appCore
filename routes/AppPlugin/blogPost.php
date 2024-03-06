<?php

use App\AppPlugin\BlogPost\BlogCategoryController;

use App\AppPlugin\Faq\FaqController;
use Illuminate\Support\Facades\Route;


Route::get('/BlogCategory',[BlogCategoryController::class,'CategoryIndex'])->name('Blog.BlogCategory.index');
Route::get('/BlogCategory/Main',[BlogCategoryController::class,'CategoryIndex'])->name('Blog.BlogCategory.index_Main');
Route::get('/BlogCategory/SubCategory/{id}',[BlogCategoryController::class,'CategoryIndex'])->name('Blog.BlogCategory.SubCategory');

Route::get('/BlogCategory/DataTable',[BlogCategoryController::class,'DataTable'])->name('Blog.BlogCategory.DataTable');
Route::get('/BlogCategory/create',[BlogCategoryController::class,'CategoryCreate'])->name('Blog.BlogCategory.create');
Route::get('/BlogCategory/create/ar',[BlogCategoryController::class,'CategoryCreate'])->name('Blog.BlogCategory.create_ar');
Route::get('/BlogCategory/create/en',[BlogCategoryController::class,'CategoryCreate'])->name('Blog.BlogCategory.create_en');
Route::get('/BlogCategory/edit/{id}',[BlogCategoryController::class,'CategoryEdit'])->name('Blog.BlogCategory.edit');
Route::get('/BlogCategory/editAr/{id}',[BlogCategoryController::class,'CategoryEdit'])->name('Blog.BlogCategory.editAr');
Route::get('/BlogCategory/editEn/{id}',[BlogCategoryController::class,'CategoryEdit'])->name('Blog.BlogCategory.editEn');
Route::get('/BlogCategory/emptyPhoto/{id}', [BlogCategoryController::class,'emptyPhoto'])->name('Blog.BlogCategory.emptyPhoto');
Route::get('/BlogCategory/DeleteLang/{id}',[BlogCategoryController::class,'DeleteLang'])->name('Blog.BlogCategory.DeleteLang');
Route::post('/BlogCategory/update/{id}',[BlogCategoryController::class,'CategoryStoreUpdate'])->name('Blog.BlogCategory.update');
Route::get('/BlogCategory/destroy/{id}',[BlogCategoryController::class,'destroyException'])->name('Blog.BlogCategory.destroy');
Route::get('/BlogCategory/config', [BlogCategoryController::class,'config'])->name('Blog.BlogCategory.config');
Route::get('/BlogCategory/emptyIcon/{id}', [BlogCategoryController::class,'emptyIcon'])->name('Blog.BlogCategory.emptyIcon');
Route::get('/BlogCategory/CatSort/{id}',[BlogCategoryController::class,'CategorySort'])->name('Blog.BlogCategory.CatSort');
Route::post('/BlogCategory/SaveSort',[BlogCategoryController::class,'CategorySaveSort'])->name('Blog.BlogCategory.SaveSort');



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
Route::get('/Faq/PhotoEdit/{id}',[FaqController::class,'More_PhotosEdit'])->name('Faq.Question.More_PhotosEdit');
Route::post('/Faq/PhotoUpdate/{id}',[FaqController::class,'More_PhotosUpdate'])->name('Faq.Question.More_PhotosUpdate');
Route::get('/Faq/PhotosEdit/{id}',[FaqController::class,'More_PhotosEditAll'])->name('Faq.Question.More_PhotosEditAll');
Route::post('/Faq/PhotoUpdateAll/{id}',[FaqController::class,'More_PhotosUpdateAll'])->name('Faq.Question.More_PhotosUpdateAll');
Route::get('/Faq/config', [FaqController::class,'config'])->name('Faq.Question.config');