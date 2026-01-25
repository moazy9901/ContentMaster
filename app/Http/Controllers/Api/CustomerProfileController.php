<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function __construct(private ImageService $imageService) {}
    public function show(Request $request)
    {
        return response()->json($request->user());
    }
    public function update(Request $request)
    {
        try {
            $customer = $request->user();
            $data = $request->validate([
                'name'   => 'sometimes|string|max:255',
                'phone'  => ['sometimes', 'unique:customers,phone,' . $customer->id, 'regex:/^01[0-9]{9}$/'],
                'gender' => 'nullable|in:male,female',
                'password' => 'sometimes|min:6|confirmed',
            ]);
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }
            $customer->update($data);
            return response()->json([
                'message'  => 'Profile updated successfully',
                'customer' => $customer
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile. Please try again.'
            ], 500);
        }
    }
    public function changeImage(Request $request)
    {
        try {
            $customer = $request->user();
            $request->validate([
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imgPath = $customer->img;
            if ($request->hasFile('img')) {
                if (!empty($customer->img)) {
                    $this->imageService->delete($customer->img);
                }
                $imgPath = $this->imageService->upload($request->file('img'), 'customers');
                $customer->update(['img' => $imgPath]);
            }
            return response()->json([
                'message' => 'Profile image updated successfully',
                'img'     => $imgPath
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile. Please try again.'
            ], 500);
        }
    }
}
