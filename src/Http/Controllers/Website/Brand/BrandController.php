<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Website\Brand;

use Kakhura\LaravelSiteBases\Http\Controllers\Website\Controller;
use Kakhura\LaravelSiteBases\Models\Brand\Brand;

class BrandController extends Controller
{
    public function brands()
    {
        $brands = Brand::where('published', true)
            ->orderBy('ordering', 'asc')
            ->with([
                'detail' => function ($query) {
                    $query->where('locale', app()->getLocale());
                },
            ])->paginate(config('kakhura.site-bases.pagination_mapper.brands'));
        return view('vendor.website.site-bases.brands.main', compact('brands'));
    }

    public function brand(Brand $brand)
    {
        $brand->load([
            'detail' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
        ]);
        return view('vendor.website.site-bases.brands.item', compact('brand'));
    }
}
