<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
      $responseConstants = config('constants.RESPONSE_CONSTANTS');
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof
                          \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => $responseConstants['STATUS_ERROR'] ,'message' => 'Token Expired', 'response_code' => 401]);
            } else if ($preException instanceof
                          \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => $responseConstants['STATUS_ERROR'] ,'message' => 'Invalid Token', 'response_code' => 401]);
            } else if ($preException instanceof
                     \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                 return response()->json(['status' => $responseConstants['STATUS_ERROR'] ,'message' => 'Token Blacklisted', 'response_code' => 401]);
           }
           if ($exception->getMessage() === 'Token not provided') {
               return response()->json(['status' => $responseConstants['STATUS_ERROR'] ,'message' => 'Token Not Provided', 'response_code' => 401]);
           }
           if ($exception->getMessage() === 'User not found') {
               return response()->json(['status' => $responseConstants['STATUS_ERROR'] ,'message' => 'User Not Found', 'response_code' => 401]);
           }
           if ($exception->getMessage() === 'A token is required') {
               return response()->json(['status' => $responseConstants['STATUS_ERROR'] ,'message' => 'Token is required', 'response_code' => 401]);
           }
           if ($exception->getMessage() === 'Token Signature could not be verified') {
               return response()->json(['status' => $responseConstants['STATUS_ERROR'] ,'message' => 'Token is not correct', 'response_code' => 401]);
           }
        }
        return parent::render($request, $exception);
    }
}
