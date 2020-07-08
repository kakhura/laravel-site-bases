<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Website\Contact;

use Kakhura\LaravelSiteBases\Http\Controllers\Website\Controller;
use Kakhura\LaravelSiteBases\Models\Contact\Contact;

class ContactController extends Controller
{
    public function contact()
    {
        $contact = Contact::with([
            'detail' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
        ])->first();
        return view('vendor.website.site-bases.contact.main', compact('contact'));
    }
}
