<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Partner;

use Illuminate\Http\Request;
use Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller;
use Kakhura\LaravelSiteBases\Http\Requests\Partner\CreateRequest;
use Kakhura\LaravelSiteBases\Http\Requests\Partner\UpdateRequest;
use Kakhura\LaravelSiteBases\Models\Partner\Partner;
use Kakhura\LaravelSiteBases\Models\Photo\Photo;
use Kakhura\LaravelSiteBases\Services\Partner\PartnerService;

class PartnerController extends Controller
{
    public function partners()
    {
        $partners = Partner::orderBy('ordering', 'asc')->paginate($limit = 100000);
        return view('vendor.admin.site-bases.partners.items', compact('partners', 'limit'));
    }

    public function createPartner()
    {
        $photos = Photo::orderBy('ordering', 'asc')->get();
        return view('vendor.admin.site-bases.partners.create', compact('photos'));
    }

    public function storePartner(CreateRequest $request, PartnerService $partnerService)
    {
        $partnerService->create($request->validated());
        return redirect('/admin/partners')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editPartner(Partner $partner)
    {
        $photos = Photo::orderBy('ordering', 'asc')->get();
        return view('vendor.admin.site-bases.partners.update', compact('partner', 'photos'));
    }

    public function updatePartner(UpdateRequest $request, PartnerService $partnerService, Partner $partner)
    {
        $update = $partnerService->update($request->validated(), $partner);

        if ($update) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით განახლდა');
            return redirect('/admin/partners');
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return redirect('/admin/partners');
    }

    public function deletePartner(Request $request, PartnerService $partnerService, Partner $partner)
    {
        if ($partnerService->delete($partner)) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით წაიშალა');
            return back();
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return back();
    }
}
