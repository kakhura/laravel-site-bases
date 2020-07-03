<?php

namespace Kakhura\LaravelSiteBases\Services\Rule;

use Illuminate\Support\Arr;
use Kakhura\LaravelSiteBases\Models\Rule\Rule;
use Kakhura\LaravelSiteBases\Services\Service;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RuleService extends Service
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $image = $this->uploadFile(Arr::get($data, 'image.0'), '/upload/about/');
        $about = Rule::create([
            'image' => Arr::get($image, 'fileName'),
            'thumb' => Arr::get($image, 'thumbFileName'),
            'video' => Arr::get($data, 'video'),
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
     * @param Rule $about
     * @return void
     */
    public function update(array $data, Rule $about)
    {
        $image = $this->uploadFile(Arr::get($data, 'image.0'), '/upload/about/', [public_path($about->image), public_path($about->thumb)], $about);
        $about->update([
            'image' => Arr::get($image, 'fileName'),
            'thumb' => Arr::get($image, 'thumbFileName'),
            'video' => Arr::get($data, 'video'),
        ]);
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $about->detail()->where('locale', $localeCode)->first()->update([
                'title' => Arr::get($data, 'title_' . $localeCode),
                'description' => Arr::get($data, 'description_' . $localeCode),
            ]);
        }
    }
}
