<?php

namespace App\Policies;

use App\Models\File;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FilePolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
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
        //
    }

    /**
     * Determine whether the user can view the model.

     */
    public function view(User $user, File $file)
    {
        return Response::allow();

    }

    /**
     * Determine whether the user can create models.

     */
    public function create(User $user)
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('You cannot upload files.');
    }

    /**
     * Determine whether the user can update the model.

     */
    public function update(User $user, File $file)
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('You cannot edit files.');
    }

    /**
     * Determine whether the user can delete the model.

     */
    public function delete(User $user, File $file)
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('You cannot delete files.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function restore(User $user, File $file)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function forceDelete(User $user, File $file)
    {
        //
    }
}
