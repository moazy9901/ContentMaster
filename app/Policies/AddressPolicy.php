<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\Customer;
use App\Models\User;

class AddressPolicy
{
    public function update($actor, Address $address)
    {
        return $this->canManageAddress($actor, $address);
    }

    public function delete($actor, Address $address)
    {
        return $this->canManageAddress($actor, $address);
    }

    private function canManageAddress($actor, Address $address)
    {
        if ($actor instanceof Customer)
            return $address->customer_id === $actor->id;
        if ($actor instanceof User)
            return in_array($actor->role, ['admin', 'super_admin']);
        return false;
    }
}
