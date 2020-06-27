<?php

namespace Kakhura\LaravelSiteBases\Http\Requests\Admin;

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
        return [
            'name' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users',
        ];
    }
}
