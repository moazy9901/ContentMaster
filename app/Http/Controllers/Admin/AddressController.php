<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Customer;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AddressController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware(['auth:web', 'admin']),];
    }
    public function __construct(protected AddressService $addressService) {}
    public function index(Customer $customer)
    {
        $addresses = $customer->addresses()->latest()->paginate(10);
        return view('admin.customers.addresses.index', compact('customer', 'addresses'));
    }

    public function create(Customer $customer)
    {
        return view('admin.customers.addresses.create', compact('customer'));
    }

    public function store(StoreAddressRequest $request, Customer $customer)
    {
        try {
            $this->addressService->createAddress($customer, $request->validated());
            return redirect()->route('admin.customers.addresses.index', $customer)
                ->with('success', 'Address added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Address added Failed.');
        }
    }

    public function edit(Customer $customer, Address $address)
    {
        return view('admin.customers.addresses.edit', compact('customer', 'address'));
    }

    public function update(UpdateAddressRequest $request, Customer $customer, Address $address)
    {
        Gate::authorize('update', $address);
        try {
            $this->addressService->updateAddress($address, $request->validated());
            return redirect()->route('admin.customers.addresses.index', $customer)
                ->with('success', 'Address updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Address updated Failed.');
        }
    }

    public function destroy(Customer $customer, Address $address)
    {
        Gate::authorize('delete', $address);
        try {
            $this->addressService->deleteAddress($address);
            return redirect()->route('admin.customers.addresses.index', $customer)
                ->with('success', 'Address deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Address deleted Failed.');
        }
    }

    public function setDefaultAddress(Customer $customer, Address $address)
    {
        Gate::authorize('update', $address);
        try {
            $this->addressService->setDefault($customer, $address);
        return redirect()->route('admin.customers.addresses.index', $customer)
            ->with('success', 'Default address updated successfully.');
             } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Default address updated Failed.');
    }
    }
}
