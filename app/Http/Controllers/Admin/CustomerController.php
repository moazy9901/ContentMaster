<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Address;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CustomerController extends Controller implements HasMiddleware
{
    public function __construct(protected CustomerService $customerService) {}
    public static function middleware(): array
    {
        return [new Middleware(['auth:web', 'admin']),];
    }

    public function index()
    {
        $customers = Customer::with('addresses')->paginate(20);
        return view('admin.customers.index', compact('customers'));
    }

    public function create(Customer $customer, Address $address)
    {
        return view('admin.customers.create', compact('customer', 'address'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $this->customerService->store($request->validated());
        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer created successfully');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->customerService->update($customer, $request->validated());

    return redirect()->route('admin.customers.index')
        ->with('success', 'Customer updated successfully');
    }

    public function show(Customer $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    public function destroy(Customer $customer)
    {
       $this->customerService->destroy($customer);
        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully');
    }
}
