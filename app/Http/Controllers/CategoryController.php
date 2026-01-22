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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(6);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('update', Category::class);
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(categoryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = ImageService::upload($request->file('image')  , 'categories');
        }
        $validData['user_id'] = Auth::id();
        Category::create($data);
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('articles');
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        Gate::authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        Gate::authorize('update', $category);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            ImageService::delete($category->image);
            $data['image'] = ImageService::upload($request->file('image') , 'categories');
        }
        $validData['user_id'] = Auth::id();
        $category->update($data);
        return redirect()->route('categories.show' , compact('category'))
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
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
