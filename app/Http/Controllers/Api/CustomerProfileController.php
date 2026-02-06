<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerImageRequest;
use App\Http\Requests\UpdateCustomerProfileRequest;
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
    public function __construct(protected ImageService $imageService) {}
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
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            $customer->update($data);
            DB::commit();
            return $this->success($customer->fresh(), null, 'Profile updated successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->error('Profile update failed');
        }
    }

    public function updateIamge(UpdateCustomerImageRequest $request)
    {
        $customer = JWTAuth::user();
        DB::beginTransaction();
        try {
            $newImage = ImageService::upload($request->file('img'), 'customers');
            if ($customer->img)
                ImageService::delete($customer->img);
            $customer->update(['img' => $newImage]);
            DB::commit();
            return $this->success($customer->fresh(), null, 'Profile image updated successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->error('Image update failed');
        }
    }
}
