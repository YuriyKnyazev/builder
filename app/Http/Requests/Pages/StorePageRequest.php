<?php

namespace App\Http\Requests\Pages;

use App\Http\Requests\Common\BaseRequest;
use App\Models\Page;

class StorePageRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:250',
            ],
            'path' => [
                'required',
                'string',
                'max:250',
                'unique:' . Page::class . ',path',
            ]
        ];
    }
}
