<?php

namespace App\Providers;

use App\Http\Controllers\RouteNotFoundController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider {


    public const HOME = '/';


    public function boot(): void {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::group(['middleware' => ['auth', 'status']], function () {
                Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
                    Route::group(['prefix' => 'admin'], function () {
                        Route::middleware('web')->group(base_path('routes/admin.php'));

                        Route::middleware('web')->group(base_path('routes/AppPlugin/siteMap.php'));

                        if(File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
                            Route::middleware('web')->group(base_path('routes/AppPlugin/config/configMeta.php'));
                        }

                        if(File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
                            Route::middleware('web')->group(base_path('routes/AppPlugin/config/webPrivacy.php'));
                        }

                        if(File::isFile(base_path('routes/AppPlugin/config/Branch.php'))) {
                            Route::middleware('web')->group(base_path('routes/AppPlugin/config/Branch.php'));
                        }


                        if(File::isFile(base_path('routes/AppPlugin/config/appSetting.php'))) {
                            Route::middleware('web')->group(base_path('routes/AppPlugin/config/appSetting.php'));
                        }

                        if(File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
                            Route::middleware('web')->group(base_path('routes/AppPlugin/data/country.php'));
                        }

                        if(File::isFile(base_path('routes/AppPlugin/leads/contactUs.php'))) {
                            Route::middleware('web')->group(base_path('routes/AppPlugin/leads/contactUs.php'));
                        }
                        if(File::isFile(base_path('routes/AppPlugin/leads/newsLetter.php'))) {
                            Route::middleware('web')->group(base_path('routes/AppPlugin/leads/newsLetter.php'));
                        }

                        if(File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
                            Route::middleware('web')->group(base_path('routes/AppPlugin/proProduct.php'));
                        }

                        if(File::isFile(base_path('routes/AppPlugin/faq.php'))) {
                            Route::middleware('web')->group(base_path('routes/AppPlugin/faq.php'));
                        }


                        Route::middleware('web')->group(base_path('routes/admin_config.php'));
                        Route::middleware('web')->group(base_path('routes/admin_roles.php'));

                    });
                });

            });

            Route::middleware('web')->group(base_path('routes/web.php'));

        });

    }
}
