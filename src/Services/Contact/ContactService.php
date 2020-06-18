<?php

namespace Kakhura\LaravelSiteBases\Services\Contact;

use Illuminate\Support\Arr;
use Kakhura\LaravelSiteBases\Models\Contact\Contact;
use Kakhura\LaravelSiteBases\Services\Service;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ContactService extends Service
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $contact = Contact::create([
            'facebook' => Arr::get($data, 'facebook'),
            'phone' => Arr::get($data, 'phone'),
            'email' => Arr::get($data, 'email'),
            'long' => Arr::get($data, 'long'),
            'lat' => Arr::get($data, 'lat'),
            'other_socials' => Arr::get($data, 'other_socials'),
        ]);
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $contact->detail()->create([
                'address' => Arr::get($data, 'address_' . $localeCode),
                'description' => Arr::get($data, 'description_' . $localeCode),
                'locale' => $localeCode,
            ]);
        }
    }

    /**
     * @param array $data
     * @param Contact $contact
     * @return void
     */
    public function update(array $data, Contact $contact)
    {
        $contact->update([
            'facebook' => Arr::get($data, 'facebook'),
            'phone' => Arr::get($data, 'phone'),
            'email' => Arr::get($data, 'email'),
            'long' => Arr::get($data, 'long'),
            'lat' => Arr::get($data, 'lat'),
            'other_socials' => Arr::get($data, 'other_socials'),
        ]);
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $contact->detail()->where('locale', $localeCode)->first()->update([
                'address' => Arr::get($data, 'address_' . $localeCode),
                'description' => Arr::get($data, 'description_' . $localeCode),
            ]);
        }
    }
}
