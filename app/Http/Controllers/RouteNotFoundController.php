<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class RouteNotFoundController extends Controller
{
    public function __invoke(){

        $Meta =  DefaultMainController::getMeatByCatId('err_404');

        $w = new WebMainController();
        $w->printSeoMeta($Meta);

        $pageView = [
            'SelMenu' => '',
            'show_fix' => true,
            'slug' => null,
            'go_home'=> route('page_index'),
        ];
        View::share('pageView', $pageView);

        $adminDir = "admin/" ;
        $currentSlug = Route::current()->originalParameters();
        if(isset($currentSlug['fallbackPlaceholder']) and  mb_substr($currentSlug['fallbackPlaceholder'], 0, 6) == $adminDir ){
            abort('410');
        }else{
            abort('404');
        }

    }
}
