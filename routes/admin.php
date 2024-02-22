<?php

use App\Http\Controllers\admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/',[DashboardController::class,'Dashboard'])->name('admin.Dashboard');
Route::get('/testpdf',[DashboardController::class,'testpdf'])->name('admin.testpdf');
Route::get('/adminTest',[DashboardController::class,'adminTest'])->name('admin.adminTest');
