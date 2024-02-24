<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */



    public function register(): void
    {

        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            $adminDir = "admin/" ;
            $currentSlug = Route::current()->uri ;
            $currentSlug = str_replace('ar/admin','admin',$currentSlug);
            $currentSlug = str_replace('en/admin','admin',$currentSlug);
            if($e->getStatusCode() == 404 and  mb_substr($currentSlug, 0, 6) == $adminDir ){
                abort(410);
            }
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
