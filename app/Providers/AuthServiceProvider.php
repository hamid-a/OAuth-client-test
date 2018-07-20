<?php

namespace App\Providers;

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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // we need two gate for authorizing two level of users
        // authorize users with access attribute in users collection
        Gate::define('admin-access', function($user) {
            return $user->access == 1;
        });

        Gate::define('dashboard-access', function($user) {
            return $user->access == 0;
        });
    }
}
