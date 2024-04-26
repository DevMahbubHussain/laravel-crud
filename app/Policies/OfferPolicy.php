<?php

namespace App\Policies;

use App\constants\Role;
use App\Models\User;

class OfferPolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user)
    {
        return $user->role === Role::USER;
    }
}
