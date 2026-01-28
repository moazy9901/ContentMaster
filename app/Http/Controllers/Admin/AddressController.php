<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Student;
use App\Models\Address;
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
    public function index(Student $student)
    {
        $addresses = $student->addresses()->latest()->paginate(10);
        return view('admin.students.addresses.index', compact('student', 'addresses'));
    }

    public function create(Student $student)
    {
        return view('admin.students.addresses.create', compact('student'));
    }

    public function store(StoreAddressRequest $request, Student $student)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->flag) {
                $student->addresses()->update(['flag' => false]);
            }
            $student->addresses()->create($data);
            DB::commit();
            return redirect()->route('admin.students.addresses.index', $student)
                         ->with('success', 'Address added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                         ->with('error', 'Address added Failed.');
        }
    }

    public function edit(Student $student, Address $address)
    {
        return view('admin.students.addresses.edit', compact('student', 'address'));
    }

    public function update(UpdateAddressRequest $request, Student $student, Address $address)
    {
        Gate::authorize('update', $address);
        try {
            DB::beginTransaction();
            if ($request->flag) {
                $address->student->addresses()->update(['flag' => false]);
            }
            $address->update($request->validated());
            DB::commit();
              return redirect()->route('admin.students.addresses.index', $student)
                         ->with('success', 'Address updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
              return redirect()->back()->with('success', 'Address updated Failed.');
        }
    }

    public function destroy(Student $student, Address $address)
    {
        $address->delete();
        return redirect()->route('admin.students.addresses.index', $student)
                         ->with('success', 'Address deleted successfully.');
    }

    public function setDefaultAddress(Student $student, Address $address)
    {
        $student->addresses()->update(['flag' => false]);
        $address->update(['flag' => true]);
        return redirect()->route('admin.students.addresses.index', $student)
                         ->with('success', 'Default address updated successfully.');
    }
}
