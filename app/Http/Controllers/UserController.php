<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
	/**
	 * @return JsonResponse
	 */
	public function index(): JsonResponse
	{
		return response()->json(User::all(['id', 'username']));
	}

	/**
	 * @param User $user
	 *
	 * @return JsonResponse
	 */
	public function show(User $user)
	{
		return response()->json([
			'id' => $user->id,
			'username' => $user->username,
		]);
	}

	/**
	 * @param Request $request
	 * @param User $user
	 */
	public function update(Request $request, User $user)
	{
		// TODO
	}

	/**
	 * @param User $user
	 */
	public function delete(User $user)
	{
		// TODO
	}
}