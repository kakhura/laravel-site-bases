<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Page;

use Kakhura\LaravelSiteBases\Http\Controllers\Controller;
use Kakhura\LaravelSiteBases\Models\About\About;
use Kakhura\LaravelSiteBases\Http\Requests\About\Request;
use Kakhura\LaravelSiteBases\Services\About\AboutService;

class AboutController extends Controller
{
    public function about()
    {
        $about = About::first();
        return view('vendor.admin.site-bases.about.edit', compact('about'));
    }

    public function storeAbout(Request $request, AboutService $aboutService)
    {
        $about = About::first();
        if (!is_null($about)) {
            $aboutService->update($request->validated(), $about);
        } else {
            $this->validate($request, [
                'image' => 'required',
            ]);
            $aboutService->create($request->validated());
        }
        return back()->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }
}
