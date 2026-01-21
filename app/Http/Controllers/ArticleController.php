<?php

namespace App\Http\Controllers;

use App\Http\Requests\articleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\ImageService;
use App\Services\SlugValidationService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('category')->latest()->paginate(6);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(articleRequest $request , ImageService $imageService)
    {
        $validData = $request->validated();
        if($request->hasFile('image')){
            $validData['image'] = $imageService->upload($request->image , 'articals');
        }
        Article::create($validData);
        return redirect()->route('articles.index')->with('success', 'Article created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article, ImageService $imageService)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imageService->delete($article->image);
            $data['image'] = $imageService->upload($request->image, 'articles');
        }
        $article->update($data);
        return redirect()->route('articles.show' , compact('article'))->with('success', 'Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article, ImageService $imageService)
    {
        $imageService->delete($article->image);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
    }
    public function validateSlug(Request $request)
    {
        return SlugValidationService::validate($request, Article::class);
    }
}
