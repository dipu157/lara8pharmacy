<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $user->role_id === 1;
        });

        Gate::define('manager', function (User $user) {
            return $user->role_id === 2;
        });

        Gate::define('user', function (User $user) {
            return $user->role_id === 3;
        });

        Gate::define('Isadmin', function (User $user) {
            return $user->role_id == 1
                        ? Response::allow()
                        : Response::deny('You must have the permission.');
        });

    }
}
