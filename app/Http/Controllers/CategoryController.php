<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ImageService;
use App\Services\SlugValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('create', Category::class);
        return view('categories.create');
    }

    public function store(categoryRequest $request)
    {
        Gate::authorize('create' , Category::class);
        $this->categoryService->store($request->validated());
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
       
    }

    public function show(Category $category)
    {
        $category->load('articles');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        Gate::authorize('update', Category::class);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        Gate::authorize('update' , Category::class);
        $this->categoryService->update($category , $request->validated());
        return redirect()->route('categories.show', compact('category'))->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);
        $this->categoryService->destroy($category);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }

    public function validateSlug(Request $request)
    {
        return SlugValidationService::validate($request, Category::class);
    }
}
