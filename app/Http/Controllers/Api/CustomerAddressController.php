<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Services\AddressService;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class CustomerAddressController extends Controller implements HasMiddleware
{
    use ApiResponse;

    public static function middleware(): array
    {
        return [new Middleware('auth:api')];
    }
    public function __construct(protected AddressService $addressService) {}
    public function index()
    {
        $customer = JWTAuth::user();
        return $this->success($customer->addresses, null, 'Addresses list');
    }

    public function store(StoreAddressRequest $request)
    {
        try {
            $customer = JWTAuth::user();
            $address = $this->addressService->createAddress($customer, $request->validated());
            return $this->success($address, null, 'Address added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Address added failed');
        }
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        Gate::authorize('update', $address);
        try {
            $address = $this->addressService->updateAddress($address, $request->validated());
            return $this->success($address, null, 'Address updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Address updated failed');
        }
    }

    public function setDefault(Address $address)
    {
        Gate::authorize('update', $address);
        try {
           $customer = JWTAuth::user();
           $this->addressService->setDefault($customer, $address);
            return $this->success($address, null, 'Default address set');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Default address set failed');
        }
    }

    public function destroy(Address $address)
    {
        Gate::authorize('delete', $address);
        try {
            $this->addressService->deleteAddress($address);
            return $this->success(null, null, 'Address deleted successfully');
        } catch (\Exception $e) {
            return $this->error('Address deleted failed');
        }
    }
}
