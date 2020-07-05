<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller;
use Kakhura\LaravelSiteBases\Http\Requests\Product\CreateRequest;
use Kakhura\LaravelSiteBases\Http\Requests\Product\UpdateRequest;
use Kakhura\LaravelSiteBases\Models\Category\Category;
use Kakhura\LaravelSiteBases\Models\Product\Product;
use Kakhura\LaravelSiteBases\Services\Product\ProductService;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::orderBy('ordering', 'asc')->paginate($limit = 100000);
        return view('vendor.admin.site-bases.products.items', compact('products', 'limit'));
    }

    public function createProduct()
    {
        $categories = Category::where('published', true)->orderBy('ordering', 'asc')->get();
        return view('vendor.admin.site-bases.products.create', compact('categories'));
    }

    public function storeProduct(CreateRequest $request, ProductService $productService)
    {
        $productService->create($request->validated());
        return redirect('/admin/products')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editProduct(Product $product)
    {
        $categories = Category::where('published', true)->orderBy('ordering', 'asc')->get();
        return view('vendor.admin.site-bases.products.update', compact('product', 'categories'));
    }

    public function updateProduct(UpdateRequest $request, ProductService $productService, Product $product)
    {
        $update = $productService->update($request->validated(), $product);

        if ($update) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით განახლდა');
            return redirect('/admin/products');
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return redirect('/admin/products');
    }

    public function deleteProduct(Request $request, ProductService $productService, Product $product)
    {
        if ($productService->delete($product)) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით წაიშალა');
            return back();
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return back();
    }

    public function productDeleteImg(Request $request, ProductService $productService)
    {
        $status = array('status' => 'error');
        if ($productService->deleteImg($request)) {
            $status['status'] = 'success';
        }
        return json_encode($status);
    }
}
