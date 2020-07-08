<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Website\About;

use Kakhura\LaravelSiteBases\Http\Controllers\Website\Controller;
use Kakhura\LaravelSiteBases\Models\About\About;

class AboutController extends Controller
{
    public function about()
    {
        $about = About::with([
            'detail' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
        ])->first();
        return view('vendor.website.site-bases.about.main', compact('about'));
    }
}
