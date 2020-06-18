<?php

namespace Kakhura\LaravelSiteBases\Requests\Contact;

use Kakhura\LaravelSiteBases\Requests\Request as BaseRequest;

class Request extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'long' => 'nullabke|string|max:255',
            'lat' => 'nullabke|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'other_socials' => 'nullable|array|min:1',
        ], $this->translationsValidation([
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]));
    }
}
