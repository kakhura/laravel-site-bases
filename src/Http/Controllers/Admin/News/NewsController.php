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
        $news = News::orderBy('ordering', 'asc')->paginate($limit = 100000);
        return view('vendor.admin.site-bases.news.items', compact('news', 'limit'));
    }

    public function createNews()
    {
        $photos = Photo::orderBy('ordering', 'asc')->get();
        return view('vendor.admin.site-bases.news.create', compact('photos'));
    }

    public function storeNews(CreateRequest $request, NewsService $newsService)
    {
        $newsService->create($request->validated());
        return redirect('/admin/news')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editNews(News $news)
    {
        $photos = Photo::orderBy('ordering', 'asc')->get();
        return view('vendor.admin.site-bases.news.update', compact('news', 'photos'));
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
