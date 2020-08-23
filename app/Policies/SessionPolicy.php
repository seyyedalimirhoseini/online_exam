<?php

namespace App\Policies;

use App\Session;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Session  $session
     * @return mixed
     */
    public function view(User $user)
    {
        if ($user->isTeacher() || $user->isAdmin())
        {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isTeacher() || $user->isAdmin())
        {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Session  $session
     * @return mixed
     */
    public function update(User $user, Session $session)
    {
        if ($user->isTeacher() || $user->isAdmin() && $user->id === $session->user_id)
        {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Session  $session
     * @return mixed
     */
    public function delete(User $user, Session $session)
    {
        if ($user->isTeacher() || $user->isAdmin() && $user->id === $session->user_id)
        {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Session  $session
     * @return mixed
     */
    public function restore(User $user, Session $session)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Session  $session
     * @return mixed
     */
    public function forceDelete(User $user, Session $session)
    {
        //
    }
    public function download(User $user, Session $session)
    {
        if ($user->isTeacher() || $user->isAdmin() && $user->id === $session->user_id)
        {
            return true;
        }
    }
    public function changeState(User $user,Session $session)
    {
        return $user->isAdmin();
    }
}
