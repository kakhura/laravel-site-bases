<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Website\Photo;

use Kakhura\LaravelSiteBases\Http\Controllers\Website\Controller;
use Kakhura\LaravelSiteBases\Models\Photo\Photo;

class PhotoController extends Controller
{
    public function photos()
    {
        $photos = Photo::where('published', true)
            ->orderBy('published_at', 'desc')
            ->with([
                'detail' => function ($query) {
                    $query->where('locale', app()->getLocale());
                },
            ])->paginate(config('kakhura.site-bases.pagination_mapper.photos'));
        return view('vendor.site-bases.website.photos.main', compact('photos'));
    }

    public function photo(Photo $photo)
    {
        $photo->load([
            'detail' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
        ]);
        return view('vendor.site-bases.website.photos.item', compact('photo'));
    }
}
