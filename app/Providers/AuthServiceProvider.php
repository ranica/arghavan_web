<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Permission;

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
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        Passport::routes();

        try
        {
            foreach ($this->getPermission() as $permission) {
                $gate->define($permission->subkey,  function($user) use ($permission)
                {
                    return $user->hasPermission($permission->subkey);
                });
            }
        }
        catch (\Exception $ex)
        {
            \Log::error ($ex);
        }

    }

    /**
     * Get Permission
     */
    protected function getPermission()
    {
        return Permission::with('roles')->get();
    }
}
