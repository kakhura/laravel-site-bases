<?php

namespace Kakhura\LaravelSiteBases\Http\Requests\Service;

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
            'video' => 'nullable|string',
            'video_image' => 'array|string',
            'published' => 'nullable|string',
        ], $this->translationsValidation([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]));
    }
}
