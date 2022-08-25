<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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

	public function render($request, Throwable $e)
	{
		if ($e instanceof AuthorizationException)
		{
			return response()->json([
				'message' => 'Action not authorized for the current session.',
			], 403);
		}

		if ($e instanceof MethodNotAllowedHttpException)
		{
			return response()->json([
				'message' => sprintf("%s method not supported for this route.", $request->method()),
			], 405);
		}

		// Unhandled exception
		return response()->json(config('app.debug')
			? [
				'message' => $e->getMessage(),
				'line' => $e->getLine(),
				'trace' => $e->getTraceAsString(),
			]
			: [
				'message' => 'Server encountered an unexpected problem while handling this request.',
			]);
	}

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->reportable(function(Throwable $e)
		{
			//
		});
	}
}
