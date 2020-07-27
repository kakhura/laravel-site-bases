<?php

namespace Kakhura\LaravelSiteBases\Http\Requests\Brand;

use Kakhura\LaravelSiteBases\Http\Requests\Request as BaseRequest;

class CreateRequest extends BaseRequest
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
            'image' => 'required|array|min:1',
            'published' => 'nullable|string',
            'video' => 'nullable|string',
            'video_image' => 'array|string',
            'link' => 'nullable|string',
        ], $this->translationsValidation([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]));
    }
}
