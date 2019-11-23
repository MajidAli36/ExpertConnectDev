<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if(env('APP_DEBUG')){
            parent::report($exception);
        }else
        if($this->isHttpException($e))
        {
            switch (intval($e->getStatusCode())) {
                // not found
                case 404:
                    return \Response::view('User\VideoCallController@error',array(),500);
                    break;
                case 500:
                    return \Response::view('User\VideoCallController@error',array(),500);
                    break;
                default:
                    return redirect('/')->with('error','Please try after some time');
                    break;
            }
        }
        else
        {
            return redirect('/error')->with('error','Please try after some time');
        }
        
        
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if(env('APP_DEBUG')){
            return parent::render($request, $exception);
        }else
        return redirect('/error')->with('error','Please try after some time');
        
    }
}
