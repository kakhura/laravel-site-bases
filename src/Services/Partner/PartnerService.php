<?php

namespace Kakhura\LaravelSiteBases\Services\Partner;

use Illuminate\Support\Arr;
use Kakhura\LaravelSiteBases\Models\Partner\Partner;
use Kakhura\LaravelSiteBases\Services\Service;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PartnerService extends Service
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $image = $this->uploadFile(Arr::get($data, 'image.0'), '/upload/partners/');
        /** @var Partner $partner */
        $partner = Partner::create([
            'image' => Arr::get($image, 'fileName'),
            'thumb' => Arr::get($image, 'thumbFileName'),
            'published' => Arr::get($data, 'published') == 'on' ? true : false,
            'video' => Arr::get($data, 'video'),
        ]);
        $partner->update([
            'ordering' => $partner->id,
        ]);
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $partner->detail()->create([
                'title' => Arr::get($data, 'title_' . $localeCode),
                'description' => Arr::get($data, 'description_' . $localeCode),
                'locale' => $localeCode,
            ]);
        }
    }

    /**
     * @param array $data
     * @param Partner $partner
     * @return bool
     */
    public function update(array $data, Partner $partner): bool
    {
        $image = $this->uploadFile(Arr::get($data, 'image.0'), '/upload/partners/', [public_path($partner->image), public_path($partner->thumb)], $partner);
        $update = $partner->update([
            'image' => Arr::get($image, 'fileName'),
            'thumb' => Arr::get($image, 'thumbFileName'),
            'published' => Arr::get($data, 'published') == 'on' ? true : false,
            'video' => Arr::get($data, 'video'),
        ]);
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $partner->detail()->where('locale', $localeCode)->first()->update([
                'title' => Arr::get($data, 'title_' . $localeCode),
                'description' => Arr::get($data, 'description_' . $localeCode),
            ]);
        }
        return $update;
    }

    /**
     * @param Partner $partner
     * @return boolean
     */
    public function delete(Partner $partner): bool
    {
        $this->deleteFiles([public_path($partner->image), public_path($partner->thumb)]);
        $partner->detail()->delete();
        return $partner->delete();
    }
}
