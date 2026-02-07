<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Throwable;

class AddressService
{
    public function createAddress(Customer $customer, array $data): Address
    {
        DB::beginTransaction();
        try {
            if (!empty($data['flag'])) {
                $customer->addresses()->update(['flag' => false]);
            }
            $address = $customer->addresses()->create($data);
            DB::commit();
            return $address;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateAddress(Address $address, array $data): Address
    {
        DB::beginTransaction();
        try {
            if (!empty($data['flag'])) {
                $address->customer->addresses()->where('id', '!=', $address->id)->update(['flag' => false]);
            }
            $address->update($data);
            DB::commit();
            return $address;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteAddress(Address $address): void
    {
        DB::beginTransaction();
        try {
            $address->delete();
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function setDefault(Customer $customer, Address $address): void
    {
        DB::beginTransaction();
        try {
            $customer->addresses()->update(['flag' => false]);
            $address->update(['flag' => true]);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
