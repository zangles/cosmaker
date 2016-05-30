<?php

namespace App\Policies;

use App\CosplayPart;
use App\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CosplayPartPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    

    public function edit(User $user,CosplayPart $part)
    {
        return CosplayPolicy::imInCosplay($user,$part->cosplay);
    }
    
    public function delete(User $user,CosplayPart $part)
    {
        return CosplayPolicy::imInCosplay($user,$part->cosplay);
    }
}
