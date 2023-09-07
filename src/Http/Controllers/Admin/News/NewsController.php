<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\News;

use Illuminate\Http\Request;
use Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller;
use Kakhura\LaravelSiteBases\Http\Requests\News\CreateRequest;
use Kakhura\LaravelSiteBases\Http\Requests\News\UpdateRequest;
use Kakhura\LaravelSiteBases\Models\News\News;
use Kakhura\LaravelSiteBases\Models\Photo\Photo;
use Kakhura\LaravelSiteBases\Services\News\NewsService;

class NewsController extends Controller
{
    public function news()
    {
        $news = News::orderBy('published_at', 'desc')->paginate(15);
        return view('vendor.site-bases.admin.news.items', compact('news'));
    }

    public function createNews()
    {
        $photos = collect();
        if (in_array('photos', config('kakhura.site-bases.modules_publish_mapper'))) {
            $photos = Photo::orderBy('ordering', 'asc')->get();
        }
        return view('vendor.site-bases.admin.news.create', compact('photos'));
    }

    public function storeNews(CreateRequest $request, NewsService $newsService)
    {
        $newsService->create($request->validated());
        return redirect('/admin/news')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editNews(News $news)
    {
        $photos = collect();
        if (in_array('photos', config('kakhura.site-bases.modules_publish_mapper'))) {
            $photos = Photo::orderBy('ordering', 'asc')->get();
        }
        return view('vendor.site-bases.admin.news.update', compact('news', 'photos'));
    }

    public function updateNews(UpdateRequest $request, NewsService $newsService, News $news)
    {
        $update = $newsService->update($request->validated(), $news);

        if ($update) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით განახლდა');
            return redirect('/admin/news');
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return redirect('/admin/news');
    }

    public function deleteNews(Request $request, NewsService $newsService, News $news)
    {
        if ($newsService->delete($news)) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით წაიშალა');
            return back();
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return back();
    }

    public function newsDeleteImg(Request $request, NewsService $newsService)
    {
        $status = array('status' => 'error');
        if ($newsService->deleteImg($request)) {
            $status['status'] = 'success';
        }
        return json_encode($status);
    }
}
