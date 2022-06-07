<?php

namespace App\Policies;

use App\Models\Pool;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PoolPolicy
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

    public function view(Pool $pool)
    {
        return true; //$pool->members->contains($user);
    }
}
