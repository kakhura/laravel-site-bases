<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Website\Partner;

use Kakhura\LaravelSiteBases\Http\Controllers\Website\Controller;
use Kakhura\LaravelSiteBases\Models\Partner\Partner;

class PartnerController extends Controller
{
    public function partners()
    {
        $partners = Partner::where('published', true)
            ->orderBy('ordering', 'asc')
            ->with([
                'detail' => function ($query) {
                    $query->where('locale', app()->getLocale());
                },
            ])->paginate(config('kakhura.site-bases.pagination_mapper.partners'));
        return view('vendor.site-bases.website.partners.main', compact('partners'));
    }

    public function partner(Partner $partner)
    {
        $partner->load([
            'detail' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
        ]);
        return view('vendor.site-bases.website.partners.item', compact('partner'));
    }
}
