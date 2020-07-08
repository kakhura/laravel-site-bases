<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Website\Page;

use Kakhura\LaravelSiteBases\Http\Controllers\Website\Controller;
use Kakhura\LaravelSiteBases\Models\Page\Page;

class PageController extends Controller
{
    public function pages()
    {
        $pages = Page::where('published', true)
            ->orderBy('ordering', 'asc')
            ->with([
                'detail' => function ($query) {
                    $query->where('locale', app()->getLocale());
                },
            ])->paginate(config('kakhura.site-bases.pagination_mapper.pages'));
        return view('vendor.website.site-bases.pages.main', compact('pages'));
    }

    public function page(Page $page)
    {
        $page->load([
            'detail' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
        ]);
        return view('vendor.website.site-bases.pages.item', compact('page'));
    }
}
