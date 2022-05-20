<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
	/**
	 * @return JsonResponse
	 * @throws AuthorizationException
	 */
	public function index(): JsonResponse
	{
		$this->authorize('viewAny', User::class);

		return response()->json(User::all(['id', 'username']));
	}

	/**
	 * @param User $user
	 *
	 * @return JsonResponse
	 * @throws AuthorizationException
	 */
	public function show(User $user)
	{
		$this->authorize('view', $user);

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