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
            $a = Rights::where('id_user', $user->id)->count();
            return $a == 0 ? false : true;
        });
  
        Gate::define('manager-show-application', function ($user, $application) {
            $a = Rights::where('id_user', $user->id)->count();
            return $a == 0 ? false : true;
        });

        Gate::define('manager-update-application', function ($user, $application) {
            $a = Rights::where('id_user', $user->id)->count();
            return $a == 0 ? false : true;
        });

        
        //client-------------------------------------------------------------------------

        Gate::define('client-index-application', function ($user) {
            $a = Rights::where('id_user', $user->id)->count();
            return $a == 0 ? true : false;
        });
  
        Gate::define('client-create-application', function ($user) {
            $a = Rights::where('id_user', $user->id)->count();
            return $a == 0 ? true : false;
        });

        Gate::define('client-store-application', function ($user, $application) {
            $a = Rights::where('id_user', $user->id)->count() == 0;
            $b = $user->id == $application->id_creator;
            return $a * $b;
        });

        Gate::define('client-show-application', function ($user, $application) {
            $a = Rights::where('id_user', $user->id)->count() == 0;
            $b = $user->id == $application->id_creator;
            return $a * $b;
        });

        Gate::define('client-update-application', function ($user, $application) {
            $a = Rights::where('id_user', $user->id)->count() == 0;
            $b = $user->id == $application->id_creator;
            return $a * $b;
        });
    }
}
