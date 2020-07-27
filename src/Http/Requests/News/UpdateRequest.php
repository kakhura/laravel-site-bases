<?php

namespace Kakhura\LaravelSiteBases\Http\Requests\News;

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
            'photo_id' => 'nullable|integer|exists:photos,id,deleted_at,NULL',
            'published' => 'nullable|string',
            'video' => 'nullable|string',
            'video_image' => 'array|string',
            'images' => 'array|min:1',
        ], $this->translationsValidation([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]));
    }
}
