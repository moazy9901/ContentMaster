<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware(['auth:web', 'admin']),];
    }
    public function __construct(protected CategoryService $categoryService) {}
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('create', Category::class);
        return view('admin.categories.create');
    }

    public function store(categoryRequest $request): RedirectResponse
    {
        Gate::authorize('create' , Category::class);
        $this->categoryService->store($request->validated());
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        Gate::authorize('update', $category);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(categoryRequest $request, Category $category): RedirectResponse
    {
        Gate::authorize('update' , Category::class);
        $this->categoryService->update($category , $request->validated());
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category): RedirectResponse
    {
        Gate::authorize('delete', $category);
        $this->categoryService->destroy($category);
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
