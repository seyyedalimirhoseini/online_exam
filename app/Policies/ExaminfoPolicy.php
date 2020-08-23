<?php

namespace App\Policies;

use App\Examinfo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExaminfoPolicy
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
     * @param  \App\Examinfo  $examinfo
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
     * @param  \App\Examinfo  $examinfo
     * @return mixed
     */
    public function update(User $user, Examinfo $examinfo)
    {
        if ($user->isTeacher() || $user->isAdmin() && $user->id === $examinfo->user_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Examinfo  $examinfo
     * @return mixed
     */
    public function delete(User $user, Examinfo $examinfo)
    {
        if ($user->isTeacher() || $user->isAdmin() && $user->id === $examinfo->user_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Examinfo  $examinfo
     * @return mixed
     */
    public function restore(User $user, Examinfo $examinfo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Examinfo  $examinfo
     * @return mixed
     */
    public function forceDelete(User $user, Examinfo $examinfo)
    {
        //
    }
//    public function changeState(User $user,Examinfo $examinfo)
//    {
//        return $user->isAdmin();
//    }
}
