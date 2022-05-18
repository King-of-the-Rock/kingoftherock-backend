<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController
{
	/**
	 * @param Request $request
	 *
	 * @return Response|JsonResponse
	 */
	public function register(Request $request)
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
			return response()
				->json($validator->errors())
				->setStatusCode(400);
		}
		
		User::create(array_merge($request->all(['email', 'username', 'password']), [
			'password' => Hash::make($request->password),
		]));

		return response()->setStatusCode(200);
	}
}
