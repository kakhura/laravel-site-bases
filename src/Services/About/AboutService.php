<?php

namespace Kakhura\LaravelSiteBases\Services\About;

use Illuminate\Support\Arr;
use Kakhura\LaravelSiteBases\Models\About\About;
use Kakhura\LaravelSiteBases\Services\Service;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AboutService extends Service
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $image = $this->uploadFile(Arr::get($data, 'image.0'));
        $about = About::create([
            'image' => Arr::get($image, 'fileName'),
            'thumb' => Arr::get($image, 'thumbFileName'),
        ]);
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $about->detail()->create([
                'title' => Arr::get($data, 'title_' . $localeCode),
                'description' => Arr::get($data, 'description_' . $localeCode),
                'locale' => $localeCode,
            ]);
        }
    }

    /**
     * @param array $data
     * @param About $about
     * @return void
     */
    public function update(array $data, About $about)
    {
        $image = $this->uploadFile(Arr::get($data, 'image.0'), [public_path($about->image), public_path($about->thumb)], '/upload/about/', $about);
        $about->update([
            'image' => Arr::get($image, 'fileName'),
            'thumb' => Arr::get($image, 'thumbFileName'),
        ]);
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $about->detail()->where('locale', $localeCode)->first()->update([
                'title' => Arr::get($data, 'title_' . $localeCode),
                'description' => Arr::get($data, 'description_' . $localeCode),
            ]);
        }
    }
}