<?php

namespace App\Exceptions;

use Exception, Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {   

        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if (Request::ajax()) {
            if ($e instanceof \Illuminate\Session\TokenMismatchException) 
                return response()->json(appError('token丢失', 1001), 200);
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)
                return response()->json(appError('不存在路由', 404), 404);
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException)
                return response()->json(appError('方法不允许', 404), 401);
            // if ($e instanceof \Symfony\Component\HttpKernel\Exception\FatalErrorException)
            //     return response()->json(appError($e->getMessage(), 500), 500);
        }
        // if ($e instanceof \Symfony\Component\HttpKernel\Exception\FatalErrorException){
        //     $res = DB::getQueryLog();
        //     // return response()->json(1231, 200);
        // }
        

        if ($e instanceof \ResultException) {
            // return response($e->getMessage(), 500);
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            return response()->json(appError($e->getMessage(), $statusCode), 200);
        }

        return parent::render($request, $e);
    }
}
