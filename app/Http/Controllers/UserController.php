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

	public function show(User $user)
	{
	}

	public function update(Request $request, User $user)
	{
	}

	public function delete(User $user)
	{
	}
}