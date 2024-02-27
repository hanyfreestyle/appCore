<?php

use App\AppPlugin\SiteMap\SiteMapController;
use Illuminate\Support\Facades\Route;

Route::get('/config/SiteMap', [SiteMapController::class, 'index'])->name('config.SiteMap.index');


