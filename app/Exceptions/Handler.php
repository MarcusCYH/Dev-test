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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        // check if request ask for Json
        //if ($request->wantsJson()){
        //    // This will replace our 404 response with
        //    // a JSON response.
        //    if ($exception instanceof ModelNotFoundException) {
        //        return response()->json([
        //            'error' => 'Resource not found'
        //        ], 404);
        //    }

        //    if ($exception instanceof ValidationException) {
        //        return response()->json([
        //            'message' => $exception->getMessage(),
        //            'errors' => $exception->$validator->errors()
        //        ], 422);
        //    }

        //    if(config('app.debug'))
        //    {
        //         $response = [
        //             'exception' => get_class($exception),
        //             'message'   => $exception->getMessage(),
        //             'trace'     => $exception->getTrace()
        //         ];

        //    }
        //    return response()->json($response, 500);
        //}

        return parent::render($request, $exception);
    }
}
