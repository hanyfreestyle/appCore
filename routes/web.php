<?php

use App\Http\Controllers\RouteNotFoundController;
use App\Http\Controllers\web\MainPagesViewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
Auth::viaRemember();
//Auth::logoutOtherDevices('password');

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
    Route::get('/under-construction', [MainPagesViewController::class, 'UnderConstruction'])->name('UnderConstruction');
});

Route::group(['middleware' => ['UnderConstruction','MinifyHtml']], function() {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
        Route::get('/', [MainPagesViewController::class, 'index'])->name('page_index');
    });
});

Route::group(['middleware' => ['UnderConstruction','MinifyHtml','localeSessionRedirect']], function() {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function(){


        Route::get('/contact-us', [MainPagesViewController::class, 'ContactUs'])->name('page_ContactUs');
        Route::post('/contact/SaveForm', [MainPagesViewController::class, 'ContactSaveForm'])->name('ContactSaveForm');
        Route::post('/contact/SaveFormOnPage', [MainPagesViewController::class, 'ContactSaveFormOnPage'])->name('ContactSaveFormOnPage');
        Route::get('/contact/thanks', [MainPagesViewController::class, 'ContactUsThanksPage'])->name('ContactUsThanksPage');

        Route::post('/req/{listId}', [MainPagesViewController::class, 'RequestListing'])->name('ContactUsRequest');
        Route::get('/contact/request', [MainPagesViewController::class, 'RequestListingView'])->name('ContactUsRequestPage');

        Route::post('/Meeting/{listId}', [MainPagesViewController::class, 'MeetingRequest'])->name('MeetingRequest');
        Route::get('/Meeting/request', [MainPagesViewController::class, 'RequestListingView'])->name('MeetingRequestPage');
        Route::get('/favorite-listing', [MainPagesViewController::class, 'FavoriteListing'])->name('FavoriteListing');



    });
});

Route::fallback(RouteNotFoundController::class);

