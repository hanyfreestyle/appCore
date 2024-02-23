<?php

use App\AppPlugin\AppPuzzle\AppPuzzleController;
use App\Http\Controllers\admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/',[DashboardController::class,'Dashboard'])->name('admin.Dashboard');
Route::get('/testpdf',[DashboardController::class,'testpdf'])->name('admin.testpdf');
Route::get('/adminTest/{model}',[DashboardController::class,'adminTest'])->name('admin.adminTest');

Route::get('/AppPuzzle/List',[AppPuzzleController::class,'IndexModel'])->name('AppPuzzle.IndexModel');
Route::get('/AppPuzzle/Copy/{model}',[AppPuzzleController::class,'CopyModel'])->name('AppPuzzle.Copy');
Route::get('/AppPuzzle/Remove/{model}',[AppPuzzleController::class,'RemoveModel'])->name('AppPuzzle.Remove');
