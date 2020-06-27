<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller;
use Kakhura\LaravelSiteBases\Http\Requests\Product\CreateRequest;
use Kakhura\LaravelSiteBases\Http\Requests\Product\UpdateRequest;
use Kakhura\LaravelSiteBases\Models\Product\Product;
use Kakhura\LaravelSiteBases\Services\Product\ProductService;

class ProductController extends Controller
{
    public function projects()
    {
        $projects = Product::orderBy('ordering', 'asc')->paginate($limit = 100000);
        return view('vendor.admin.site-bases.projects.items', compact('projects', 'limit'));
    }

    public function createProduct()
    {
        return view('vendor.admin.site-bases.projects.create');
    }

    public function storeProduct(CreateRequest $request, ProductService $projectService)
    {
        $projectService->create($request->validated());
        return redirect('/admin/projects')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editProduct(Product $project)
    {
        return view('vendor.admin.site-bases.projects.update', compact('project'));
    }

    public function updateProduct(UpdateRequest $request, ProductService $projectService, Product $project)
    {
        $update = $projectService->update($request->validated(), $project);

        if ($update) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით განახლდა');
            return redirect('/admin/projects');
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return redirect('/admin/projects');
    }

    public function deleteProduct(Request $request, ProductService $projectService, Product $project)
    {
        if ($projectService->delete($project)) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით წაიშალა');
            return back();
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return back();
    }

    public function projectDeleteImg(Request $request, ProductService $projectService)
    {
        $status = array('status' => 'error');
        if ($projectService->deleteImg($request)) {
            $status['status'] = 'success';
        }
        return json_encode($status);
    }
}
