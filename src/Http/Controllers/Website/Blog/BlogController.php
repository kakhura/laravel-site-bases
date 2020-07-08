<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Website\Blog;

use Kakhura\LaravelSiteBases\Http\Controllers\Website\Controller;
use Kakhura\LaravelSiteBases\Models\Blog\Blog;

class BlogController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::where('published', true)
            ->orderBy('ordering', 'asc')
            ->with([
                'detail' => function ($query) {
                    $query->where('locale', app()->getLocale());
                },
            ])->paginate(config('kakhura.site-bases.pagination_mapper.blogs'));
        return view('vendor.website.site-bases.blogs.main', compact('blogs'));
    }

    public function blog(Blog $blog)
    {
        $blog->load([
            'detail' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
        ]);
        return view('vendor.website.site-bases.blogs.item', compact('blog'));
    }
}
