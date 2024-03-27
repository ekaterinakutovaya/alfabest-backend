<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->is('api/*')) {
            $jsonResponse = parent::render($request, $e);
            return $this->processApiException($jsonResponse);
        }

        return parent::render($request, $e);
    }

    private function processApiException($originalResponse)
    {
        if($originalResponse instanceof JsonResponse){
            $data = $originalResponse->getData(true);
            $data['status'] = $originalResponse->getStatusCode();
            $data['errors'] = [Arr::get($data, 'exception', 'Something went wrong!')];
            $data['message'] = Arr::get($data, 'message', '');
            $originalResponse->setData($data);
        }

        return $originalResponse;
    }
}
