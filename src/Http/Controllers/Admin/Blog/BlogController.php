<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller;
use Kakhura\LaravelSiteBases\Http\Requests\Blog\CreateRequest;
use Kakhura\LaravelSiteBases\Http\Requests\Blog\UpdateRequest;
use Kakhura\LaravelSiteBases\Models\Blog\Blog;
use Kakhura\LaravelSiteBases\Models\Photo\Photo;
use Kakhura\LaravelSiteBases\Services\Blog\BlogService;

class BlogController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::orderBy('published_at', 'desc')->paginate(15);
        return view('vendor.site-bases.admin.blogs.items', compact('blogs'));
    }

    public function createBlog()
    {
        $photos = collect();
        if (in_array('photos', config('kakhura.site-bases.modules_publish_mapper'))) {
            $photos = Photo::orderBy('ordering', 'asc')->get();
        }
        return view('vendor.site-bases.admin.blogs.create', compact('photos'));
    }

    public function storeBlog(CreateRequest $request, BlogService $blogService)
    {
        $blogService->create($request->validated());
        return redirect('/admin/blogs')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editBlog(Blog $blog)
    {
        $photos = collect();
        if (in_array('photos', config('kakhura.site-bases.modules_publish_mapper'))) {
            $photos = Photo::orderBy('ordering', 'asc')->get();
        }
        return view('vendor.site-bases.admin.blogs.update', compact('blog', 'photos'));
    }

    public function updateBlog(UpdateRequest $request, BlogService $blogService, Blog $blog)
    {
        $update = $blogService->update($request->validated(), $blog);

        if ($update) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით განახლდა');
            return redirect('/admin/blogs');
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return redirect('/admin/blogs');
    }

    public function deleteBlog(Request $request, BlogService $blogService, Blog $blog)
    {
        if ($blogService->delete($blog)) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით წაიშალა');
            return back();
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return back();
    }

    public function blogDeleteImg(Request $request, BlogService $blogService)
    {
        $status = array('status' => 'error');
        if ($blogService->deleteImg($request)) {
            $status['status'] = 'success';
        }
        return json_encode($status);
    }
}
