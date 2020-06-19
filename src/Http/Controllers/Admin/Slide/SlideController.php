<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Page;

use Kakhura\LaravelSiteBases\Http\Controllers\Controller;
use Kakhura\LaravelSiteBases\Http\Requests\Slide\CreateRequest;
use Kakhura\LaravelSiteBases\Http\Requests\Slide\UpdateRequest;
use Kakhura\LaravelSiteBases\Models\Slide\Slide;

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

    public function storeSlide(CreateRequest $request)
    {
        $image = $request->image[0];
        $extension = $image->getClientOriginalExtension();
        $image_name = '/upload/slides/' . Str::random() . '.' . $extension;
        $image_path = public_path($image_name);
        file_put_contents($image_path, file_get_contents($image));

        $slide = Slide::create([
            'image' => $image_name,
            'published' => $request->published == 'on' ? true : false,
            'main' => $request->main == 'on' ? true : false,
            'type_id' => $request->type_id,
            'area' => $request->area,
            'balcony_area' => $request->balcony_area,
            'rooms' => $request->rooms,
            'bathroom' => $request->bathroom,
            'first_satge_height' => $request->first_satge_height,
            'second_satge_height' => $request->second_satge_height,
            'balcony' => $request->balcony,
            'construction' => $request->construction,
            'stages' => $request->stages,
        ]);

        $slide->update([
            'ordering' => $slide->id,
        ]);

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $slide->detail()->create([
                'title' => $request->input('title_' . $localeCode),
                'description' => $request->input('description_' . $localeCode),
                'equipment' => $request->input('equipment_' . $localeCode),
                'lang' => $localeCode,
            ]);
        }

        return redirect('/admin/slides')->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }

    public function editSlide(Slide $slide)
    {
        return view('vendor.admin.site-bases.slides.update', compact('slide'));
    }

    public function updateSlide(UpdateRequest $request, Slide $slide)
    {
        if (!is_null($image = Arr::get($request->image, 0))) {
            File::delete(public_path($slide->image));
            $extension = $image->getClientOriginalExtension();
            $image_name = '/upload/slides/' . Str::random() . '.' . $extension;
            $image_path = public_path($image_name);
            file_put_contents($image_path, file_get_contents($image));
        } else {
            $image_name = $slide->image;
        }

        $update = $slide->update([
            'image' => $image_name,
            'published' => $request->published == 'on' ? true : false,
            'main' => $request->main == 'on' ? true : false,
            'type_id' => $request->type_id,
            'area' => $request->area,
            'balcony_area' => $request->balcony_area,
            'rooms' => $request->rooms,
            'bathroom' => $request->bathroom,
            'first_satge_height' => $request->first_satge_height,
            'second_satge_height' => $request->second_satge_height,
            'balcony' => $request->balcony,
            'construction' => $request->construction,
            'stages' => $request->stages,
        ]);

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $slide->detail()->where('lang', $localeCode)->first()->update([
                'title' => $request->input('title_' . $localeCode),
                'description' => $request->input('description_' . $localeCode),
                'equipment' => $request->input('equipment_' . $localeCode),
            ]);
        }

        if (!empty($request->images)) {
            foreach ($request->images as $key => $images) {
                $extension = $images->getClientOriginalExtension();
                $images_name = '/upload/slides/' . Str::random() . '.' . $extension;
                $images_path = public_path($images_name);
                file_put_contents($images_path, file_get_contents($images));
                $slide->images()->create([
                    'image' => $images_name,
                ]);
            }
        }

        if (!empty($request->plans)) {
            foreach ($request->plans as $key => $plans) {
                $extension = $plans->getClientOriginalExtension();
                $plans_name = '/upload/slides/' . Str::random() . '.' . $extension;
                $plans_path = public_path($plans_name);
                file_put_contents($plans_path, file_get_contents($plans));
                $slide->plans()->create([
                    'image' => $plans_name,
                ]);
            }
        }

        if ($update) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით განახლდა');
            return redirect('/admin/slides');
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return redirect('/admin/slides');
    }

    public function deleteSlide(Request $request, Slide $slide)
    {
        File::delete(public_path($slide->image));
        foreach ($slide->images as $key => $value) {
            File::delete(public_path($value->image));
            $value->delete();
        }
        foreach ($slide->plans as $key => $value) {
            File::delete(public_path($value->image));
            $value->delete();
        }
        foreach ($slide->detail as $key => $detail) {
            $detail->delete();
        }

        $delete = $slide->delete();

        if ($delete) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'ინფორმაცია წარმატებით წაიშალა');
            return back();
        }
        $request->session()->flash('status', 'error');
        $request->session()->flash('message', 'დაფიქსირდა შეცდომა');
        return back();
    }

    public function slidePublish(Request $request)
    {
        $status = array('status' => 'error');
        $slide = Slide::find($request->id);

        $update = $slide->update([
            'published' => $request->published,
        ]);

        if ($update) {
            $status['status'] = 'success';
        }
        return json_encode($status);
    }
}
