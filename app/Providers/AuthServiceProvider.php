<?php

namespace App\Providers;

use App\User;
use App\Comment;
use App\Policies\UserPolicy;
use App\Policies\CommentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
		      Comment::class => CommentPolicy::class,
          User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user) {
            if ($user->hasRole('Admin')) {
                return true;
            }
        });
        //Creates the functions that rules the apllication
        Gate::resource('comment', 'App\Policies\CommentPolicy');
        Gate::resource('user', 'App\Policies\UserPolicy');
    }
}
