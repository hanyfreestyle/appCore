<?php

use App\Http\Controllers\web\BlogsViewController;
use App\Http\Controllers\web\DevelopersViewController;
use App\Http\Controllers\web\ListingsListController;
use App\Http\Controllers\web\LocationsViewController;
use App\Http\Controllers\web\MainPagesViewController;
use App\Http\Controllers\web\PagesViewController;
use App\Http\Controllers\web\ProjectViewController;
use App\Http\Controllers\web\SearchController;
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

        Route::get('/search', [SearchController::class, 'Search'])->name('Search');


        Route::get('/contact-us', [MainPagesViewController::class, 'ContactUs'])->name('page_ContactUs');
        Route::post('/contact/SaveForm', [MainPagesViewController::class, 'ContactSaveForm'])->name('ContactSaveForm');
        Route::post('/contact/SaveFormOnPage', [MainPagesViewController::class, 'ContactSaveFormOnPage'])->name('ContactSaveFormOnPage');
        Route::get('/contact/thanks', [MainPagesViewController::class, 'ContactUsThanksPage'])->name('ContactUsThanksPage');

        Route::post('/req/{listId}', [MainPagesViewController::class, 'RequestListing'])->name('ContactUsRequest');
        Route::get('/contact/request', [MainPagesViewController::class, 'RequestListingView'])->name('ContactUsRequestPage');

        Route::post('/Meeting/{listId}', [MainPagesViewController::class, 'MeetingRequest'])->name('MeetingRequest');
        Route::get('/Meeting/request', [MainPagesViewController::class, 'RequestListingView'])->name('MeetingRequestPage');
        Route::get('/favorite-listing', [MainPagesViewController::class, 'FavoriteListing'])->name('FavoriteListing');

        Route::get('/listings/{type}', [PagesViewController::class, 'ListingPageView'])->name('page_ListingPageView');

        Route::get('/developers', [DevelopersViewController::class, 'DevelopersList'])->name('page_developers');
        Route::get('/developers/{slug}', [DevelopersViewController::class, 'DeveloperView'])->name('page_developer_view');

        Route::get('/blog', [BlogsViewController::class, 'BlogList'])->name('page_blog');
        Route::get('/blog/{catSlug}', [BlogsViewController::class, 'BlogCatList'])->name('page_blogCatList');
        Route::get('/blog/{catSlug}/{postSlug}', [BlogsViewController::class, 'BlogView'])->name('page_blogView');

        Route::get('/compounds', [ListingsListController::class, 'CompoundsList'])->name('page_compounds');
        Route::get('/for-sale', [ListingsListController::class, 'ForSaleList'])->name('page_for_sale');

        Route::get('/{listingid}', [ProjectViewController::class, 'ListView'])
            ->name('page_ListView')->where('listingid','^(\d+)+-+[^\/]+$');

        Route::get('{slug}', [LocationsViewController::class, 'LocationView'])
            ->name('page_locationView')->where('slug', '(.*)');

    });
});


//Route::fallback(RouteNotFoundController::class);
