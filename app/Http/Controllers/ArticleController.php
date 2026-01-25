<?php

namespace App\Http\Controllers;

use App\Http\Requests\articleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\ImageService;
use App\Services\SlugValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->latest()->paginate(20);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        Gate::authorize('create' , Article::class);
        $categories = Category::pluck('name', 'id');
        return view('articles.create', compact('categories'));
    }

    public function store(articleRequest $request , ImageService $imageService)
    {
        try{
        $validData = $request->validated();
        if($request->hasFile('image')){
            $validData['image'] = $imageService->upload($request->image , 'articals');
        }
        $validData['user_id']=Auth::id();
        Article::create($validData);
        return redirect()->route('articles.index')->with('success', 'Article created successfully');
        }catch(\Exception $ex){
            return redirect()->back()->with('failed', 'Article created Failed')->withInput();
        }

    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        Gate::authorize('update', $article);
        $categories = Category::pluck('name', 'id');
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(ArticleRequest $request, Article $article, ImageService $imageService)
    {
        try{
        Gate::authorize('update', $article);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imageService->delete($article->image);
            $data['image'] = $imageService->upload($request->image, 'articles');
        }
        $validData['user_id'] = Auth::id();
        $article->update($data);
        return redirect()->route('articles.show' , compact('article'))->with('success', 'Article updated successfully');
        }catch(\Exception $ex){
            return redirect()->back()->with('failed', 'Article created Failed')->withInput();
        }
    }

    public function destroy(Article $article, ImageService $imageService)
    {
        Gate::authorize('delete', $article);
        $imageService->delete($article->image);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
    }

    public function validateSlug(Request $request)
    {
        return SlugValidationService::validate($request, Article::class);
    }
}
