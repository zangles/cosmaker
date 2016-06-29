<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CosplayTaskPolicy
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

    public function edit(User $user,Task $task)
    {
        return CosplayPolicy::imInCosplay($user,$task->cosplay);
    }

    public function delete(User $user,Task $task)
    {
        return CosplayPolicy::imInCosplay($user,$task->cosplay);
    }
}
