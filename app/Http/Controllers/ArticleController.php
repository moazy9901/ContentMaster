<?php

namespace App\Http\Controllers;

use App\Http\Requests\articleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleService;
use App\Services\ImageService;
use App\Services\SlugValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct(protected ArticleService $articleService) {}
    public function index()
    {
        $articles = Article::with('category')->latest()->paginate(20);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        Gate::authorize('create' , Article::class);
        $categories = Category::select('name', 'id')->get();
        return view('articles.create', compact('categories'));
    }

    public function store(articleRequest $request)
    {
        Gate::authorize('create' , Article::class);
        $this->articleService->store($request->validated());
        return redirect()->route('articles.index')->with('success', 'Article created successfully');
        
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        Gate::authorize('update', $article);
        $categories = Category::select('name', 'id')->get();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        Gate::authorize('update', $article);
         $this->articleService->update($article , $request->validated());
        return redirect()->route('articles.show' , compact('article'))->with('success', 'Article updated successfully');
    }

    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);
         $this->articleService->destroy($article);
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
    }

    public function validateSlug(Request $request)
    {
        return SlugValidationService::validate($request, Article::class);
    }
}
