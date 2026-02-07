<?php

namespace App\Services;

use App\Models\Article;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class ArticleService
{
    public function __construct(protected ImageService $imageService) {}

    public function store(array $data): Article
    {
        DB::beginTransaction();
        $uploadedImage = null;
        try {
            if (!empty($data['image'])) {
                $uploadedImage = $this->imageService->upload($data['image'], 'articles');
                $data['image'] = $uploadedImage;
            }
            $data['user_id'] = Auth::id();
            $article = Article::create($data);
            DB::commit();
            return $article;
        } catch (Throwable $e) {
            DB::rollBack();
            if ($uploadedImage) {
                $this->imageService->delete($uploadedImage);
            }
            throw $e;
        }
    }

    public function update(Article $article, array $data): Article
    {
        DB::beginTransaction();
        $uploadedImage = null;
        try {
            if (!empty($data['image'])) {
                if ($article->image) {
                    $this->imageService->delete($article->image);
                }
                $uploadedImage = $this->imageService
                    ->upload($data['image'], 'articles');
                $data['image'] = $uploadedImage;
            } else {
                unset($data['image']);
            }
            $article->update($data);
            DB::commit();
            return $article;

        } catch (Throwable $e) {
            DB::rollBack();
            if ($uploadedImage) {
                $this->imageService->delete($uploadedImage);
            }
            throw $e;
        }
    }

    public function destroy(Article $article): void
    {
        DB::beginTransaction();

        try {
            if ($article->image) {
                $this->imageService->delete($article->image);
            }
            $article->delete();
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
