<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\articleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware(['auth:web', 'admin']),];
    }
    public function __construct(protected ImageService $imageService) {}
    public function index()
    {
        $articles = Article::with('category')->orderBy('id', 'desc')->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::select('name', 'id')->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(articleRequest $request): RedirectResponse
    {
        try{
        $validData = $request->validated();
        if($request->hasFile('image')){
            $validData['image'] = $this->imageService->upload($request->file('image'), 'articles');
            }
            $validData['user_id']=Auth::id();
            Article::create($validData);
            return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully');
            }catch(\Exception $ex){
                 return redirect()->back()->with('failed', 'Article created Failed')->withInput();
            }
    }

    public function edit(Article $article)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|unique:articles,title,' . $article->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'required|string',
            'description' => 'nullable|string|max:500',
            'keywords' => 'nullable|string|max:255',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'description' => $request->description,
            'keywords' => $request->keywords,
        ];

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully');
    }
}
