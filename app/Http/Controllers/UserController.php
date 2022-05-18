<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController
{
	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function register(Request $request): JsonResponse
	{
		$validator = Validator::make($request->all(), [
			'email' => [
				'required',
				'email',
				'unique:users',
			],
			'username' => [
				'required',
				'unique:users',
			],
			'password' => [
				'required',
			],
		]);
		
		if ($validator->fails()) {
			return response()->json($validator->errors())->setStatusCode(400);
		}
		
		return response()->json($request->all());
	}
}
