<?php

namespace Kakhura\LaravelSiteBases\Http\Requests\Category;

use Kakhura\LaravelSiteBases\Http\Requests\Request as BaseRequest;
use Kakhura\LaravelSiteBases\Models\Category\Category;

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
            'image' => 'nullable|array|min:1',
            'parent_id' => sprintf('nullable|integer|exists:%s.categories,id,deleted_at,NULL', config(sprintf('kakhura.site-bases.models_connection_mapper.%s', Category::class))),
            'published' => 'nullable|string',
        ], $this->translationsValidation([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]));
    }
}
