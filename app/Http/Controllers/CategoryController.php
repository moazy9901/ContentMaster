<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryRequest;
use App\Models\Category;
use App\Services\ImageService;
use App\Services\SlugValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('update', Category::class);
        return view('categories.create');
    }

    public function store(categoryRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = ImageService::upload($request->file('image'), 'categories');
            }
            $validData['user_id'] = Auth::id();
            Category::create($data);
            return redirect()->route('categories.index')
                ->with('success', 'Category created successfully!');
        } catch (\Exception $ex) {
            report($ex); // ask eng abd elkreem
            return redirect()->back()->with('failed', 'Category created Failed')->withInput();
        }
    }

    public function show(Category $category)
    {
        $category->load('articles');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        Gate::authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            Gate::authorize('update', $category);
            $data = $request->validated();
            if ($request->hasFile('image')) {
                ImageService::delete($category->image);
                $data['image'] = ImageService::upload($request->file('image'), 'categories');
            }
            $validData['user_id'] = Auth::id();
            $category->update($data);
            return redirect()->route('categories.show', compact('category'))
                ->with('success', 'Category updated successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('Failed', 'Category updateded Failed')->withInput();
        }
    }

    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }

    public function validateSlug(Request $request)
    {
        return SlugValidationService::validate($request, Category::class);
    }
}
