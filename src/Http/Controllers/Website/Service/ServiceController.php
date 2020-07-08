<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Website\Service;

use Kakhura\LaravelSiteBases\Http\Controllers\Website\Controller;
use Kakhura\LaravelSiteBases\Models\Service\Service;

class ServiceController extends Controller
{
    public function services()
    {
        $services = Service::where('published', true)
            ->orderBy('ordering', 'asc')
            ->with([
                'detail' => function ($query) {
                    $query->where('locale', app()->getLocale());
                },
            ])->paginate(config('kakhura.site-bases.pagination_mapper.services'));
        return view('vendor.website.site-bases.services.main', compact('services'));
    }

    public function service(Service $service)
    {
        $service->load([
            'detail' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
        ]);
        return view('vendor.website.site-bases.services.item', compact('service'));
    }
}
