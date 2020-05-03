<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Rights;

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
        
        //manager------------------------------------------------------------------------

        Gate::define('manager-index-application', function ($user) {
            return $user->isManager();
        });
  
        Gate::define('manager-show-application', function ($user, $application) {
            return $user->isManager();
        });

        Gate::define('manager-update-application', function ($user, $application) {
            return $user->isManager();
        });

        
        //client-------------------------------------------------------------------------

        Gate::define('client-index-application', function ($user) {
            return $user->isClient();
        });
  
        Gate::define('client-create-application', function ($user) {
            return $user->isClient();
        });

        Gate::define('client-store-application', function ($user, $application) {
            return $user->isClient();
        });

        Gate::define('client-show-application', function ($user, $application) {
            $is_creator = $user->id == $application->id_creator;
            return $is_creator;
        });

        Gate::define('client-update-application', function ($user, $application) {
            $is_creator = $user->id == $application->id_creator;
            return $is_creator;
        });
    }
}
