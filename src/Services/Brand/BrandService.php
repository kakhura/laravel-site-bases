<?php

namespace Kakhura\LaravelSiteBases\Services\Brand;

use Illuminate\Support\Arr;
use Kakhura\LaravelSiteBases\Models\Brand\Brand;
use Kakhura\LaravelSiteBases\Services\Service;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BrandService extends Service
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $image = $this->uploadFile(Arr::get($data, 'image.0'), '/upload/brands/');
        /** @var Brand $brand */
        $brand = Brand::create([
            'image' => Arr::get($image, 'fileName'),
            'thumb' => Arr::get($image, 'thumbFileName'),
            'published' => Arr::get($data, 'published') == 'on' ? true : false,
            'video' => Arr::get($data, 'video'),
        ]);
        $brand->update([
            'ordering' => $brand->id,
        ]);
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $brand->detail()->create([
                'title' => Arr::get($data, 'title_' . $localeCode),
                'description' => Arr::get($data, 'description_' . $localeCode),
                'locale' => $localeCode,
            ]);
        }
    }

    /**
     * @param array $data
     * @param Brand $brand
     * @return bool
     */
    public function update(array $data, Brand $brand): bool
    {
        $image = $this->uploadFile(Arr::get($data, 'image.0'), '/upload/brands/', [public_path($brand->image), public_path($brand->thumb)], $brand);
        $update = $brand->update([
            'image' => Arr::get($image, 'fileName'),
            'thumb' => Arr::get($image, 'thumbFileName'),
            'published' => Arr::get($data, 'published') == 'on' ? true : false,
            'video' => Arr::get($data, 'video'),
        ]);
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $brand->detail()->where('locale', $localeCode)->first()->update([
                'title' => Arr::get($data, 'title_' . $localeCode),
                'description' => Arr::get($data, 'description_' . $localeCode),
            ]);
        }
        return $update;
    }

    /**
     * @param Brand $brand
     * @return boolean
     */
    public function delete(Brand $brand): bool
    {
        $this->deleteFiles([public_path($brand->image), public_path($brand->thumb)]);
        $brand->detail()->delete();
        return $brand->delete();
    }
}
