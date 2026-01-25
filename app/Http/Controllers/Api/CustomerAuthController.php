<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function __construct(private ImageService $imageService) {}
    public function register(CustomerRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = bcrypt($request->password);
            if ($request->hasFile('img')) {
                $data['img'] = $this->imageService->upload($request->file('img'), 'customers');
            }
            $customer = Customer::create($data);
            $token = $customer->createToken('customer-token')->plainTextToken;
            return response()->json([
                'success' => true,
                'customer' => $customer,
                'token' => $token
            ], 201);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed. Please try again.'
            ], 500);
        }
    }
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $customer = Customer::where('email', $request->email)->first();
            if (!$customer || !Hash::check($request->password, $customer->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
            $token = $customer->createToken('customer-token')->plainTextToken;
            return response()->json([
                'customer' => $customer,
                'token' => $token
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed. Please try again.'
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
