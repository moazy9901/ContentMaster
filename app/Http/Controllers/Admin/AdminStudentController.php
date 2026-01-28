<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminStudentController extends Controller
{
    public function index(Student $student)
    {
        return view('admin.students.addresses.index', [
            'student' => $student,
            'addresses' => $student->addresses
        ]);
    }

    public function store(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'details' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'governorate' => 'required|string',
            'flag' => 'boolean'
        ]);
        if (!empty($data['flag'])) {
            $student->addresses()->update(['flag' => false]);
        }
        $student->addresses()->create($data);
        return back()->with('success', 'Address added successfully');
    }

    public function update(Request $request, Address $address)
    {
        Gate::authorize('update', $address);

        if ($request->flag) {
            $address->student->addresses()->update(['flag' => false]);
        }

        $address->update($request->validated());

        return back()->with('success', 'Address updated');
    }

    public function setDefault(Address $address)
    {
        Gate::authorize('update', $address);

        $address->student->addresses()->update(['flag' => false]);
        $address->update(['flag' => true]);

        return back()->with('success', 'Default address updated');
    }

    public function destroy(Address $address)
    {
        Gate::authorize('delete', $address);
        $address->delete();

        return back()->with('success', 'Address deleted');
    }
}
