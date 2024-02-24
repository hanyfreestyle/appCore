<?php


use App\AppPlugin\Config\Apps\AppSettingController;
use Illuminate\Support\Facades\Route;


Route::get('/app/setting', [AppSettingController::class, 'AppSetting'])->name('App.AppSetting.form');
Route::post('/app/settingUpdate', [AppSettingController::class, 'AppSettingUpdate'])->name('App.AppSetting.AppSettingUpdate');
Route::get('/app/photo', [AppSettingController::class, 'AppPhotos'])->name('App.AppPhotos.form');

Route::get('/app/MenuList', [AppSettingController::class, 'index'])->name('App.AppMenuList.index');
Route::get('/app/Menu/create',[AppSettingController::class,'create'])->name('App.AppMenuList.create');
Route::get('/app/Menu/edit/{id}',[AppSettingController::class,'edit'])->name('App.AppMenuList.edit');
Route::get('/app/Menu/destroy/{id}',[AppSettingController::class,'destroy'])->name('App.AppMenuList.destroy');
Route::post('/app/Menu/update/{id}',[AppSettingController::class,'storeUpdate'])->name('App.AppMenuList.update');
Route::get('/app/Menu/Sort',[AppSettingController::class,'Sort'])->name('App.AppMenuList.Sort');
Route::post('/app/Menu/SaveSort',[AppSettingController::class,'SaveSort'])->name('App.AppMenuList.SaveSort');

Route::get('/app/profile', [AppSettingController::class, 'AppProfile'])->name('App.AppProfile.form');
Route::get('/app/cart', [AppSettingController::class, 'AppCart'])->name('App.AppCart.form');
Route::post('/app/profileUpdate', [AppSettingController::class, 'AppProfileUpdate'])->name('App.AppProfileUpdate');




