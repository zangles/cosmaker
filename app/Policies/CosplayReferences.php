<?php

namespace App\Policies;

use App\Referencias;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CosplayReferences
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

    public function delete(User $user,Referencias $ref)
    {
        return CosplayPolicy::imInCosplay($user,$ref->cosplay);
    }
}
