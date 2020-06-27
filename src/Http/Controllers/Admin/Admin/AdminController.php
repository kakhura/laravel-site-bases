<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Admin;

use Illuminate\Http\Request;
use Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller;
use Kakhura\LaravelSiteBases\Http\Requests\Admin\CreateRequest;
use Kakhura\LaravelSiteBases\Http\Requests\Admin\UpdateRequest;
use App\Models\User;
use Kakhura\LaravelSiteBases\Services\Admin\AdminService;

class AdminController extends Controller
{
    public function admins()
    {
        $admins = User::latest()->paginate(10);
        return view('vendor.admin.site-bases.admins.items', compact('admins'));
    }

    public function createAdmin()
    {
        return view('vendor.admin.site-bases.admins.create');
    }

    public function storeAdmin(CreateRequest $request, AdminService $adminService)
    {
        $adminService->create($request->validated());
        return redirect('/admin/admins')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editAdmin(User $admin)
    {
        return view('vendor.admin.site-bases.admins.update', compact('admin'));
    }

    public function updateAdmin(UpdateRequest $request, AdminService $adminService, User $admin)
    {
        $update = $adminService->update($request->validated(), $admin);

        if ($update) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით განახლდა');
            return redirect('/admin/admins');
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return redirect('/admin/admins');
    }

    public function deleteAdmin(Request $request, AdminService $adminService, User $admin)
    {
        if ($admin->delete()) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით წაიშალა');
            return back();
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return back();
    }
}
