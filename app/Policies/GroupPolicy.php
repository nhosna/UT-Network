<?php

namespace App\Policies;

use App\Facades\Utilities;
use App\Models\Group;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GroupPolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if ($user->isSuper()) {
            return Response::allow();
        }
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return Response::allow();



    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function view(User $user, Group $group)
    {
        return Utilities::isMemberOf($user,$group)
            ? Response::allow()
            : Response::deny('You are not a member of this group.');
    }




    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('You cannot create groups.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function update(User $user, Group $group)
    {
        return Utilities::isAdminOf($user,$group)
            ? Response::allow()
            : Response::deny('You are not the admin of this group.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function delete(User $user, Group $group)
    {
        return Utilities::isAdminOf($user,$group)
            ? Response::allow()
            : Response::deny('You are not the admin of this group.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function restore(User $user, Group $group)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function forceDelete(User $user, Group $group)
    {
        //
    }
}
