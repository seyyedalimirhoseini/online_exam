<?php

namespace App\Policies;

use App\Forum;
use App\ResponseForum;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResponseForumPolicy
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
     * @param  \App\ResponseForum  $responseForum
     * @return mixed
     */
    public function view(User $user, ResponseForum $responseForum)
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
    public function create(User $user,Forum $forum)
    {
        if ($user->isTeacher() || $user->isAdmin() && $user->id === $forum->user_id)
        {
            return true;
        }
    }
    public function store(User $user)
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
     * @param  \App\ResponseForum  $responseForum
     * @return mixed
     */
    public function update(User $user, ResponseForum $responseForum)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ResponseForum  $responseForum
     * @return mixed
     */
    public function delete(User $user, Forum $forum)
    {
        if ($user->isTeacher() || $user->isAdmin() && $user->id === $forum->user_id)
        {
            return  true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\ResponseForum  $responseForum
     * @return mixed
     */
    public function restore(User $user, ResponseForum $responseForum)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ResponseForum  $responseForum
     * @return mixed
     */
    public function forceDelete(User $user, ResponseForum $responseForum)
    {
        //
    }
    public function show(User $user,Forum $forum)
    {
        if ($user->isTeacher() || $user->isAdmin() && $user->id === $forum->user_id)
        {
            return  true;
        }
    }
}
