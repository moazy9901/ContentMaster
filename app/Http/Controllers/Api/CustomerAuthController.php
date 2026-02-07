<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use App\Services\ImageService;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerAuthController extends Controller implements HasMiddleware
{
    use ApiResponse;
    public function __construct(protected ImageService $imageService) {}
    public static function middleware(): array
    {
        return [new Middleware('auth:api', except: ['login', 'register']),];
    }
    public function register(StoreCustomerRequest $request, CustomerService $customerService)
    {
        $customer = $customerService->store($request->validated());
        $token = JWTAuth::fromUser($customer);
        return $this->success($customer, $token, 'Registration Successfully.', 201);
    }

    public function login(LoginCustomerRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return $this->error('Invalid credentials', 401);
        }
        $customer = auth('api')->user();
        return $this->success($customer, $token, 'Login successful');
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return $this->success(null, null, 'Logged out successfully');
    }

    public function refresh()
    {
        $newToken = JWTAuth::refresh(JWTAuth::getToken());
        return $this->success(null, $newToken, 'Token refreshed');
    }
}
