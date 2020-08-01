<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller;
use Kakhura\LaravelSiteBases\Http\Requests\Category\CreateRequest;
use Kakhura\LaravelSiteBases\Http\Requests\Category\UpdateRequest;
use Kakhura\LaravelSiteBases\Models\Category\Category;
use Kakhura\LaravelSiteBases\Services\Category\CategoryService;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::with('childrenRecursive')->whereNull('parent_id')->orderBy('ordering', 'asc')->get();
        return view('vendor.site-bases.admin.categories.items', compact('categories'));
    }

    public function createCategory()
    {
        $categories = Category::with('childrenRecursive')->get();
        return view('vendor.site-bases.admin.categories.create', compact('categories'));
    }

    public function storeCategory(CreateRequest $request, CategoryService $categoryService)
    {
        $categoryService->create($request->validated());
        return redirect('/admin/categories')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editCategory(Category $category)
    {
        $categories = Category::with('childrenRecursive')->get();
        return view('vendor.site-bases.admin.categories.update', compact('category', 'categories'));
    }

    public function updateCategory(UpdateRequest $request, CategoryService $categoryService, Category $category)
    {
        $update = $categoryService->update($request->validated(), $category);

        if ($update) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით განახლდა');
            return redirect('/admin/categories');
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return redirect('/admin/categories');
    }

    public function deleteCategory(Request $request, CategoryService $categoryService, Category $category)
    {
        if ($categoryService->delete($category)) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით წაიშალა');
            return back();
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return back();
    }
}
