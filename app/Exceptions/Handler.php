<?php

namespace App\Exceptions;

use App\Exceptions\Http\Auth\InvalidToken;
use App\Exceptions\Http\ForbiddenHttpException;
use App\Exceptions\Http\UnauthorizedHttpException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            //1. неверный логин/пароль code 1
            //2. Неверный токен code 2
            //3. Токен протух code 3
            //4. Пользователь отключен code 4
            return new JsonResponse([
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ], 401);
        }

        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], 403);
        }

        if ($exception instanceof \Spatie\Permission\Exceptions\RoleDoesNotExist) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], 400);
        }

        if ($exception instanceof HttpExceptionInterface) {
            return $this->prepareJsonResponse($request, $exception);
        }

        if ($exception instanceof ModelNotFoundException) {
            return new JsonResponse('Model not found', 404);
        }


        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        throw new InvalidToken();
    }
}
