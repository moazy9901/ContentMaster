<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentProfileRequest;
use App\Models\Address;
use App\Models\Student;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class StudentController extends Controller implements HasMiddleware
{
    public function __construct(protected ImageService $imageService) {}
    public static function middleware(): array
    {
        return [new Middleware(['auth:web', 'admin']),];
    }

    public function index()
    {
        $students = Student::with('addresses')->paginate(20);
        return view('admin.students.index', compact('students'));
    }

    public function create(Student $student, Address $address)
    {
        return view('admin.students.create', compact('student', 'address'));
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $uploadedImage = null;
            if ($request->hasFile('image')) {
                $uploadedImage = $this->imageService->upload($request->file('image'), 'students');
            }
            $data['image'] = $uploadedImage;
            Student::create($data);
            DB::commit();
            return redirect()->route('admin.students.index')
                ->with('success', 'Student created successfully');
        } catch (\Throwable $e) {
            if ($uploadedImage) {
                $this->imageService->delete($uploadedImage);
            }
            DB::rollBack();
            return redirect()->back()
                ->with('sucerrorcess', 'Student created faild');
        }
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(UpdateStudentProfileRequest $request, Student $student)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $uploadedImage = null;
            if ($request->hasFile('image')) {
                ImageService::delete($student->img);
                $uploadedImage = $this->imageService->upload($request->file('image'), 'students');
            }
            $data['image'] = $uploadedImage;
            Student::update($data);
            DB::commit();
            return redirect()->route('admin.students.index')
                ->with('success', 'Student updated successfully');
        } catch (\Throwable $e) {
            if ($uploadedImage) {
                $this->imageService->delete($uploadedImage);
            }
            DB::rollBack();
            return redirect()->back()
                ->with('sucerrorcess', 'Student updated faild');
        }
    }

    public function destroy(Student $student)
    {
        if($student->image)
            ImageService::delete($student->img);
        $student->delete();
        return redirect()->back()->with('success', 'Student deleted successfully.');
    }

}
