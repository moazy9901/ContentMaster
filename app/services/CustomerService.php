<?php

namespace App\Services;

use App\Models\Customer;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class CustomerService
{
    public function __construct(protected ImageService $imageService) {}

    public function store(array $data)
    {
        $uploadedImage = null;
        try {
            DB::beginTransaction();
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            if (!empty($data['image'])) {
                $uploadedImage = $this->imageService->upload($data['image'], 'customers');
            }
            $data['image'] = $uploadedImage;
            $customer = Customer::create($data);
            DB::commit();
            return $customer;
        } catch (\Throwable $e) {
            if ($uploadedImage) {
                $this->imageService->delete($uploadedImage);
            }
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Customer $customer, array $data): Customer
    {
        try {
            DB::beginTransaction();
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            if (!empty($data['image'])) {
                $this->imageService->delete($customer->image);
                $data['image'] = $this->imageService->upload($data['image'], 'customers');
            }
            $customer->update($data);
            DB::commit();
            return $customer;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateImage(Customer $customer, $image): Customer
    {
        $newImage = null;
        try {
            DB::beginTransaction();
            $newImage = $this->imageService->upload($image, 'customers');
            if(!empty($data['image'])){
            if ($customer->image) {
                $this->imageService->delete($customer->image);
            }
            $customer->update(['image' => $newImage]);
            }
            DB::commit();
            return $customer;
        } catch (Throwable $e) {
            DB::rollBack();
            if ($newImage) {
                $this->imageService->delete($newImage);
            }
            throw $e;
        }
    }

    public function destroy(Customer $customer): void
    {
        try {
            DB::beginTransaction();
            if ($customer->image) {
                $this->imageService->delete($customer->image);
            }
            $customer->addresses()->delete();
            $customer->delete();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
