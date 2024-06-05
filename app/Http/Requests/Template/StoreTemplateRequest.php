<?php

namespace App\Http\Requests\Template;

use App\Http\Requests\Common\BaseRequest;
use App\Models\Template;

class StoreTemplateRequest extends BaseRequest
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
                'max:100',
                'unique:' . Template::class . ',name'
            ],
            'image' => [
                'required',
                'file'
            ]
        ];
    }
}
