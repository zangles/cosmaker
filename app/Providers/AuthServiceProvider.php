<?php

namespace App\Providers;

use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
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
        'App\Cosplay' => 'App\Policies\CosplayPolicy',
        'App\CosplayPart' => 'App\Policies\CosplayPartPolicy',
        'App\Gasto' => 'App\Policies\GastoPolicy',
        'App\Task' => 'App\Policies\CosplayTaskPolicy',
        'App\Referencias' => 'App\Policies\CosplayReferences'
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('admin', function (User $user) {
            return $user->isAdmin();
        });
    }
}
