<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerImageRequest;
use App\Http\Requests\UpdateCustomerProfileRequest;
use App\Services\CustomerService;
use App\Services\ImageService;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerProfileController extends Controller implements HasMiddleware
{
    use ApiResponse;
    public function __construct(protected CustomerService $customerService) {}
    public static function middleware(): array
    {
        return [new Middleware('auth:api'),];
    }
    public function me()
    {
        $customer = JWTAuth::user();
        return $this->success($customer, null, 'Authenticated customer');
    }
    public function update(UpdateCustomerProfileRequest $request)
    {
        $customer = JWTAuth::user();
        $this->customerService->update($customer, $request->validated());
        return $this->success($customer->fresh(), null, 'Profile updated successfully');
    }

    public function updateImage(UpdateCustomerImageRequest $request)
    {
        $customer = JWTAuth::user();
        $this->customerService->updateImage($customer, $request->file('image'));
        return $this->success($customer->fresh(), null, 'Profile image updated successfully');
    }
}
