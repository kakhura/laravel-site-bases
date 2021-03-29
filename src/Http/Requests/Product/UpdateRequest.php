<?php

namespace Kakhura\LaravelSiteBases\Http\Requests\Product;

use Kakhura\LaravelSiteBases\Http\Requests\Request as BaseRequest;
use Kakhura\LaravelSiteBases\Models\Category\Category;

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
            'category_id' => sprintf('nullable|integer|exists:%s.categories,id,deleted_at,NULL', config(sprintf('kakhura.site-bases.models_connection_mapper.%s', Category::class))),
            'price' => 'nullable|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'published' => 'nullable|string',
            'video' => 'nullable|string',
            'video_image' => 'array|min:1',
            'images' => 'array|min:1',
        ], $this->translationsValidation([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]));
    }
}
