<?php

namespace App\Policies;

use App\Cosplay;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CosplayPolicy
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

    public function createPart(User $user,Cosplay $cosplay)
    {
        return $this->imInCosplay($user,$cosplay);
    }

    public function createCost(User $user,Cosplay $cosplay)
    {
        return CosplayPolicy::imInCosplay($user,$cosplay);
    }
    
    public function delete(User $user,Cosplay $cosplay)
    {
        return $this->imInCosplay($user,$cosplay);
    }
    
    public function viewDetaills(User $user, Cosplay $cosplay)
    {
        return $this->imInCosplay($user,$cosplay);
    }

    public static function imInCosplay(User $user, Cosplay $cosplay)
    {
        return (count($cosplay->users()->where('user_id',$user->id)->get()) > 0);
    }

}
