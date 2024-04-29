<?php

namespace App\Policies;

use App\constants\Role;
use App\Models\Offer;
use App\Models\User;

class OfferPolicy
{
    public function viewAny(User $user)
    {
        return $user->role === Role::ADMIN;
    }

    public function viewMy(User $user)
    {
        return $user->role === Role::USER;
    }
    /**
     * Create a new policy instance.
     */
    public function create(User $user)
    {
        return $user->role === Role::USER;
    }

    public function update(User $user, Offer $offer)
    {
        // return $user->role === Role::ADMIN  || ($user->role === Role::USER && $user->id == $offer->author_id);
        return $user->role === Role::ADMIN || ($user->role === Role::USER && $user->id === $offer->author_id);
    }
}
