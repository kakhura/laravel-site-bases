<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin\Page;

use Kakhura\LaravelSiteBases\Http\Controllers\Controller;
use Kakhura\LaravelSiteBases\Models\Contact\Contact;
use Kakhura\LaravelSiteBases\Http\Requests\Contact\Request;
use Kakhura\LaravelSiteBases\Services\Contact\ContactService;

class ContactController extends Controller
{
    public function contact()
    {
        $contact = Contact::first();
        return view('vendor.admin.site-bases.contact.edit', compact('contact'));
    }

    public function storeContact(Request $request, ContactService $contactService)
    {
        $contact = Contact::first();
        if (!is_null($contact)) {
            $contactService->update($request->validated(), $contact);
        } else {
            $contactService->create($request->validated());
        }
        return back()->with(['success' => 'ინფორმაცია წარმატებით შეიცვალა']);
    }
}
