<?php

namespace Kakhura\LaravelSiteBases\Http\Requests\Partner;

use Kakhura\LaravelSiteBases\Http\Requests\Request as BaseRequest;

class UpdateRequest extends BaseRequest
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
            'image' => 'array|min:1',
            'published' => 'nullable|string',
            'video' => 'nullable|string',
        ], $this->translationsValidation([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]));
    }
}
