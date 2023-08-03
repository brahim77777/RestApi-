<?php

namespace App\Policies;

use App\Models\user;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, user $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
        return $user->role === "admin"
        ? Response::allow()
        : Response::deny('You do not have permission to create new users.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, user $model)
    {
        return $user->id === $model->id  || $user->role === "admin"
        ? Response::allow()
        : Response::deny('You do not have permission to perform this action.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, user $model)
    {
        return $user->id === $model->id  || $user->role === "admin"
        ? Response::allow()
        : Response::deny('You do not have permission to perform this action.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, user $model)
    {
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, user $model)
    {
    }
}
