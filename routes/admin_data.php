<?php
use App\Http\Controllers\data\ContactUsFormController;
use App\Http\Controllers\data\CountryController;
use App\Http\Controllers\data\NewsLetterController;
use Illuminate\Support\Facades\Route;

Route::get('/LeadsFrom/Request',[ContactUsFormController::class,'indexAll'])->name('LeadsFrom.Request.index');
Route::post('/LeadsFrom/Request', [ContactUsFormController::class, 'indexAll'])->name('LeadsFrom.Request.filter');
Route::get('/RequestCall/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.Request.Export');
Route::post('/RequestCall/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.Request.Export');
Route::get('/RequestCall/destroy/{id}', [ContactUsFormController::class,'destroy'])->name('LeadsFrom.Request.destroy');

Route::get('/LeadsFrom/ContactUs',[ContactUsFormController::class,'indexAll'])->name('LeadsFrom.ContactUs.index');
Route::post('/LeadsFrom/ContactUs', [ContactUsFormController::class, 'indexAll'])->name('LeadsFrom.ContactUs.filter');
Route::get('/ContactUs/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.ContactUs.Export');
Route::post('/ContactUs/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.ContactUs.Export');
Route::get('/ContactUs/destroy/{id}', [ContactUsFormController::class,'destroy'])->name('LeadsFrom.ContactUs.destroy');

Route::get('/LeadsFrom/Meeting',[ContactUsFormController::class,'indexAll'])->name('LeadsFrom.Meeting.index');
Route::post('/LeadsFrom/Meeting', [ContactUsFormController::class, 'indexAll'])->name('LeadsFrom.Meeting.filter');
Route::get('/Meeting/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.Meeting.Export');
Route::post('/Meeting/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.Meeting.Export');
Route::get('/Meeting/destroy/{id}', [ContactUsFormController::class,'destroy'])->name('LeadsFrom.Meeting.destroy');


Route::get('/LeadsFrom/config', [ContactUsFormController::class, 'config'])->name('LeadsFrom.config');


Route::get('/config/NewsLetter', [NewsLetterController::class, 'index'])->name('config.NewsLetter.index');
Route::post('/config/NewsLetter', [NewsLetterController::class, 'index'])->name('config.NewsLetter.filter');
Route::get('/config/NewsLetter/config', [NewsLetterController::class, 'config'])->name('config.NewsLetter.config');
Route::get('/config/NewsLetter/ExportFile', [NewsLetterController::class, 'Export'])->name('config.NewsLetter.Export');
Route::post('/config/NewsLetter/ExportFile', [NewsLetterController::class, 'Export'])->name('config.NewsLetter.Export');
Route::get('/config/NewsLetter/{id}', [NewsLetterController::class,'destroy'])->name('config.NewsLetter.destroy');


Route::get('/Country/',[CountryController::class,'index'])->name('data.Country.index');
Route::post('/Country/', [CountryController::class, 'index'])->name('data.Country.filter');
Route::get('/Country/create',[CountryController::class,'create'])->name('data.Country.create');
Route::get('/Country/create/ar',[CountryController::class,'create'])->name('data.Country.create_ar');
Route::get('/Country/create/en',[CountryController::class,'create'])->name('data.Country.create_en');
Route::get('/Country/edit/{id}',[CountryController::class,'edit'])->name('data.Country.edit');
Route::get('/Country/emptyPhoto/{id}', [CountryController::class,'emptyPhoto'])->name('data.Country.emptyPhoto');
Route::post('/Country/update/{id}',[CountryController::class,'storeUpdate'])->name('data.Country.update');
Route::get('/Country/destroy/{id}',[CountryController::class,'destroy'])->name('data.Country.destroy');
Route::get('/Country/SoftDelete/',[CountryController::class,'SoftDeletes'])->name('data.Country.SoftDelete');
Route::get('/Country/restore/{id}',[CountryController::class,'Restore'])->name('data.Country.restore');
Route::get('/Country/force/{id}',[CountryController::class,'ForceDelete'])->name('data.Country.force');
Route::get('/Country/config', [CountryController::class,'config'])->name('data.Country.config');
Route::post('/Country/updateStatus', [CountryController::class,'updateStatus'])->name('data.Country.updateStatus');
