<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginStudentRequest;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\Student;
use App\Services\ImageService;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class StudentAuthController extends Controller implements HasMiddleware
{
    use ApiResponse;
    public function __construct(protected ImageService $imageService) {}
    public static function middleware(): array
    {
        return [new Middleware('auth:api', except: ['login', 'register']),];
    }
    public function register(RegisterStudentRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $uploadedImage = null;
            if ($request->hasFile('img')) {
                $uploadedImage = $this->imageService->upload($request->file('img'), 'students');
            }
            $data['img'] = $uploadedImage;
            $student = Student::create($data);
            $token = JWTAuth::fromUser($student);
            DB::commit();
            return $this->success($student, $token, 'Registration Successfully.', 201);
        } catch (\Throwable $e) {
            if ($uploadedImage) {
                $this->imageService->delete($uploadedImage);
            }
            DB::rollBack();
            return $this->error("Registration failed. Please try again.");
        }
    }

    public function login(LoginStudentRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->error('Invalid credentials', 401);
        }
        $student = auth('api')->user();
        return $this->success($student , $token , 'Login successful');
    }

    public function me()
    {
        $student = auth('api')->user();
        return $this->success($student,null,'Authenticated student');
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return $this->success(null,null,'Logged out successfully');
    }

    public function refresh()
    {
        $newToken = JWTAuth::refresh(JWTAuth::getToken());
        return $this->success(null , $newToken , 'Token refreshed');
    }
}
