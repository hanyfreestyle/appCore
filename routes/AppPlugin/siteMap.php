<?php

use App\AppPlugin\SiteMap\SiteMapController;
use Illuminate\Support\Facades\Route;

Route::get('/config/SiteMap', [SiteMapController::class, 'index'])->name('config.SiteMap.index');
Route::post('/config/UpdateDeveloper', [SiteMapController::class, 'UpdateDeveloper'])->name('config.SiteMap.UpdateDeveloper');
Route::post('/config/UpdateBlog', [SiteMapController::class, 'UpdateBlog'])->name('config.SiteMap.UpdateBlog');
Route::post('/config/UpdateListingAr', [SiteMapController::class, 'UpdateListing'])->name('config.SiteMap.UpdateListingAr');
Route::post('/config/UpdateListingEn', [SiteMapController::class, 'UpdateListing'])->name('config.SiteMap.UpdateListingEn');
Route::post('/config/UpdateIndex', [SiteMapController::class, 'UpdateIndex'])->name('config.SiteMap.UpdateIndex');
Route::post('/config/UpdateForSale', [SiteMapController::class, 'UpdateForSale'])->name('config.SiteMap.UpdateForSale');

