<?php

namespace App\Policies;
use App\Facades\Utilities;
use App\Models\Group;
use Illuminate\Auth\Access\Response;
use App\Models\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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
     */
    public function viewAny(User $user)
    {
        if($user->isAdmin()){
            return Response::allow();

        }
        else{
            return  Response::deny('You do not have permission to view this page.');
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     */
    public function view(User $user, Post $post)
    {
        return Utilities::isMemberOf($user,$post->group) || $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('You are not a member of this group.');
    }

    /**
     * Determine whether the user can create models.
     *
     */
    public function create(User $user,Group $group)
    {
        return Utilities::isAdminOf($user,$group)
            ? Response::allow()
            : Response::deny('You are not the admin of this group.');
    }

    /**
     * Determine whether the user can update the model.
     *
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('You are not the author of this post.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('You are not the author of this post.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     */
    public function restore(User $user, Post $post)
    {

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
