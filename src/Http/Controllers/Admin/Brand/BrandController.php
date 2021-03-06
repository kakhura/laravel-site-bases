<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Brand;

use Illuminate\Http\Request;
use Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller;
use Kakhura\LaravelSiteBases\Http\Requests\Brand\CreateRequest;
use Kakhura\LaravelSiteBases\Http\Requests\Brand\UpdateRequest;
use Kakhura\LaravelSiteBases\Models\Brand\Brand;
use Kakhura\LaravelSiteBases\Services\Brand\BrandService;

class BrandController extends Controller
{
    public function brands()
    {
        $brands = Brand::orderBy('ordering', 'asc')->paginate($limit = 100000);
        return view('vendor.site-bases.admin.brands.items', compact('brands', 'limit'));
    }

    public function createBrand()
    {
        return view('vendor.site-bases.admin.brands.create');
    }

    public function storeBrand(CreateRequest $request, BrandService $brandService)
    {
        $brandService->create($request->validated());
        return redirect('/admin/brands')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editBrand(Brand $brand)
    {
        return view('vendor.site-bases.admin.brands.update', compact('brand'));
    }

    public function updateBrand(UpdateRequest $request, BrandService $brandService, Brand $brand)
    {
        $update = $brandService->update($request->validated(), $brand);

        if ($update) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით განახლდა');
            return redirect('/admin/brands');
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return redirect('/admin/brands');
    }

    public function deleteBrand(Request $request, BrandService $brandService, Brand $brand)
    {
        if ($brandService->delete($brand)) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით წაიშალა');
            return back();
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return back();
    }
}
