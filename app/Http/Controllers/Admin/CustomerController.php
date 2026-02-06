<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerProfileRequest;
use App\Models\Address;
use App\Models\Customer;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CustomerController extends Controller implements HasMiddleware
{
    public function __construct(protected ImageService $imageService) {}
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
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $uploadedImage = null;
            if ($request->hasFile('image')) {
                $uploadedImage = $this->imageService->upload($request->file('image'), 'customers');
            }
            $data['image'] = $uploadedImage;
            Customer::create($data);
            DB::commit();
            return redirect()->route('admin.customers.index')
                ->with('success', 'Customer created successfully');
        } catch (\Throwable $e) {
            if ($uploadedImage) {
                $this->imageService->delete($uploadedImage);
            }
            DB::rollBack();
            return redirect()->back()
                ->with('sucerrorcess', 'Customer created faild');
        }
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerProfileRequest $request, Customer $customer)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $uploadedImage = null;
            if ($request->hasFile('image')) {
                ImageService::delete($customer->img);
                $uploadedImage = $this->imageService->upload($request->file('image'), 'customers');
            }
            $data['image'] = $uploadedImage;
            $customer->update($data);
            DB::commit();
            return redirect()->route('admin.customers.index')
                ->with('success', 'Customer updated successfully');
        } catch (\Throwable $e) {
            if ($uploadedImage) {
                $this->imageService->delete($uploadedImage);
            }
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Customer updated failed');
        }
    }

    public function show(Customer $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    public function destroy(Customer $customer)
    {
        try {
            DB::beginTransaction();
            if ($customer->img) {
                ImageService::delete($customer->img);
            }
            $customer->addresses()->delete();
            $customer->delete();
            DB::commit();
            return redirect()->route('admin.customers.index')
                ->with('success', 'Customer deleted successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Customer deleted failed');
        }
    }
}
