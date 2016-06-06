<?php

namespace App\Policies;

use App\Cosplay;
use App\Gasto;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GastoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    

    public function edit(User $user,Gasto $gasto)
    {
        return CosplayPolicy::imInCosplay($user,$gasto->cosplay);
    }

    public function delete(User $user,Gasto $gasto)
    {
        return CosplayPolicy::imInCosplay($user,$gasto->cosplay);
    }
}
