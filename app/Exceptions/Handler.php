<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
        $this->reportable(function (Throwable $e) {
            if($e){
                return Response::json( 
                    ['error'=> 'the Page not Found!!'],404
                );
            }
        });
        $this->reportable(function (Exception $e) {
            return Response::json('not FOund!!!');
        });
    }

    public function render($request , $exception){
        if($exception instanceof ModelNotFoundException){
            return Response::json(['error'=> 'Not Found !.']);
        }
        if($exception instanceof MethodNotAllowedHttpException){
            return Response::json(['error'=> 'Method Not  Allowed For This Route !.']);
            
        }


        return parent::render($request , $exception);
    }
}
