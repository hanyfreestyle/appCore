<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteNotFoundController extends Controller
{
    public function __invoke(){
        dd('hi');
    }
}
