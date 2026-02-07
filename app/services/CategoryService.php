<?php

namespace App\Services;

use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
class CategoryService
{
    public function __construct(protected ImageService $imageService) {}
    public function store(array $data): Category
    {
        DB::beginTransaction();
        $uploadedImage = null;
        try {
            if (!empty($data['image'])) {
                $uploadedImage = $this->imageService->upload($data['image'], 'categories');
                $data['image'] = $uploadedImage;
            }
            $data['user_id'] = Auth::id();
            $Category = Category::create($data);
            DB::commit();
            return $Category;
        } catch (Throwable $e) {
            DB::rollBack();
            if ($uploadedImage) {
                $this->imageService->delete($uploadedImage);
            }
            throw $e;
        }
    }

    public function update(Category $Category, array $data): Category
    {
        DB::beginTransaction();
        $uploadedImage = null;
        try {
            if (!empty($data['image'])) {
                if ($Category->image) {
                    $this->imageService->delete($Category->image);
                }
                $uploadedImage = $this->imageService->upload($data['image'], 'categories');
                $data['image'] = $uploadedImage;
            } else {
                unset($data['image']);
            }
            $Category->update($data);
            DB::commit();
            return $Category;
        } catch (Throwable $e) {
            DB::rollBack();
            if ($uploadedImage) {
                $this->imageService->delete($uploadedImage);
            }
            throw $e;
        }
    }

    public function destroy(Category $Category): void
    {
        DB::beginTransaction();
        try {
            if ($Category->image) {
                $this->imageService->delete($Category->image);
            }
            $Category->articles()->delete();
            $Category->delete();
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
