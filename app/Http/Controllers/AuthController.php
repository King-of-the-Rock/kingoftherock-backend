<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return JsonResponse|null
	 */
	public function register(Request $request)
	{
		// TODO don't send web page for unsupported request method
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

		if ($validator->fails())
		{
			return response()
				->json($validator->errors(), 400);
		}

		User::create(array_merge($request->all(['email', 'username', 'password']), [
			'password' => Hash::make($request->password),
		]));
	}

	public function login(Request $request)
	{
		$credentials = $request->validate([
			'email' => 'required',
			'password' => 'required',
		]);
		if (Auth::attempt($credentials))
		{
			$request->session()->regenerate();
			return;
		}

		return response()
			->json([
				'password' => 'Email or password incorrect.',
			], 401);
	}
}
