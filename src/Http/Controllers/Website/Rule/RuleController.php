<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Website\Rule;

use Kakhura\LaravelSiteBases\Http\Controllers\Website\Controller;
use Kakhura\LaravelSiteBases\Models\Rule\Rule;

class RuleController extends Controller
{
    public function rules()
    {
        $rules = Rule::with([
            'detail' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
        ])->first();
        return view('vendor.site-bases.website.rules.main', compact('rules'));
    }
}
