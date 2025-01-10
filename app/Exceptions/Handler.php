<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException; // Importar la excepción de autenticación
use Throwable;

class Handler extends ExceptionHandler
{
    // ...

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
        if ($exception instanceof AuthenticationException && $request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return parent::render($request, $exception);
    }
}