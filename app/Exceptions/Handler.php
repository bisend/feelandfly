<?php

namespace App\Exceptions;

use App\Helpers\UrlBuilder;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,

        NotFoundHttpException::class,
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
        parent::report($exception);
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
        $language = config('app.locale');

        if ($exception instanceof BadRequestHttpException)
        {
            return redirect(UrlBuilder::error(400, $language));
        }
        else if ($exception instanceof UnauthorizedHttpException)
        {
            return redirect(UrlBuilder::error(401, $language));
        }
        else if ($exception instanceof AccessDeniedHttpException)
        {
            return redirect(UrlBuilder::error(403, $language));
        }
        else if($exception instanceof NotFoundHttpException)
        {
            return redirect(UrlBuilder::error(404, $language));
        }
        else if ($exception instanceof HttpException)
        {
            return redirect(UrlBuilder::error(500, $language));
        }
        
        return parent::render($request, $exception);
    }
}
