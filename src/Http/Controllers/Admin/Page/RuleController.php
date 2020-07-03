<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Page;

use Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller;
use Kakhura\LaravelSiteBases\Models\Rule\Rule;
use Kakhura\LaravelSiteBases\Http\Requests\Rule\Request;
use Kakhura\LaravelSiteBases\Services\Rule\RuleService;

class RuleController extends Controller
{
    public function about()
    {
        $about = Rule::first();
        return view('vendor.admin.site-bases.about.edit', compact('about'));
    }

    public function storeRule(Request $request, RuleService $aboutService)
    {
        $about = Rule::first();
        if (!is_null($about)) {
            $aboutService->update($request->validated(), $about);
        } else {
            $aboutService->create($request->validated());
        }
        return back()->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }
}
