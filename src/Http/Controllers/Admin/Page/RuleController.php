<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Page;

use Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller;
use Kakhura\LaravelSiteBases\Models\Rule\Rule;
use Kakhura\LaravelSiteBases\Http\Requests\Rule\Request;
use Kakhura\LaravelSiteBases\Services\Rule\RuleService;

class RuleController extends Controller
{
    public function rules()
    {
        $rules = Rule::first();
        return view('vendor.admin.site-bases.rules.edit', compact('rules'));
    }

    public function storeRules(Request $request, RuleService $ruleService)
    {
        $rules = Rule::first();
        if (!is_null($rules)) {
            $ruleService->update($request->validated(), $rules);
        } else {
            $ruleService->create($request->validated());
        }
        return back()->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }
}
