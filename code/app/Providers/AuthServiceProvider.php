<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\File;
use App\Models\Group;
use App\Models\Post;
use App\Models\Vote;
use App\Policies\CommentPolicy;
use App\Policies\FilePolicy;
use App\Policies\GroupPolicy;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Policies\VotePolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',

             Post::class => PostPolicy::class,
             User::class => UserPolicy::class,
             Group::class => GroupPolicy::class,
             Vote::class => VotePolicy::class,
             Comment::class => CommentPolicy::class,
//             File::class => FilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
