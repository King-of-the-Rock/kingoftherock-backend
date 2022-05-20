<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can interact with the model.
	 * @param User|null $user
	 *
	 * @return bool
	 */
	public function viewAny(?User $user) {
		return isset($user);
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param User|null $user
	 * @param User $model
	 *
	 * @return Response|bool
	 */
	public function view(?User $user, User $model)
	{
		return isset($user);
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param User $user
	 * @param User $model
	 *
	 * @return Response|bool
	 */
	public function update(User $user, User $model)
	{
		return $user->id === $model->id;
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param User $user
	 * @param User $model
	 *
	 * @return Response|bool
	 */
	public function delete(User $user, User $model)
	{
		return $user->id == $model->id;
	}
}
