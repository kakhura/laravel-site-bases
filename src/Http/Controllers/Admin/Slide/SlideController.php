<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Page;

use Illuminate\Http\Request;
use Kakhura\LaravelSiteBases\Http\Controllers\Controller;
use Kakhura\LaravelSiteBases\Http\Requests\Slide\CreateRequest;
use Kakhura\LaravelSiteBases\Http\Requests\Slide\UpdateRequest;
use Kakhura\LaravelSiteBases\Models\Slide\Slide;
use Kakhura\LaravelSiteBases\Services\Slide\SlideService;

class SlideController extends Controller
{
    public function slides()
    {
        $slides = Slide::orderBy('ordering', 'asc')->paginate($limit = 100000);
        return view('vendor.admin.site-bases.slides.items', compact('slides', 'limit'));
    }

    public function createSlide()
    {
        return view('vendor.admin.site-bases.slides.create');
    }

    public function storeSlide(CreateRequest $request, SlideService $slideService)
    {
        $slideService->create($request->validated());
        return redirect('/admin/slides')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editSlide(Slide $slide)
    {
        return view('vendor.admin.site-bases.slides.update', compact('slide'));
    }

    public function updateSlide(UpdateRequest $request, SlideService $slideService, Slide $slide)
    {
        $update = $slideService->update($request->validated(), $slide);

        if ($update) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით განახლდა');
            return redirect('/admin/slides');
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return redirect('/admin/slides');
    }

    public function deleteSlide(Request $request, SlideService $slideService, Slide $slide)
    {
        if ($slideService->delete($slide)) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით წაიშალა');
            return back();
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return back();
    }
}
