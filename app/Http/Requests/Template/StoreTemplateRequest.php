<?php

namespace App\Http\Requests\Template;

use App\Enums\TemplateTypeEnum;
use App\Http\Requests\Common\BaseRequest;
use App\Models\Template;
use Illuminate\Validation\Rules\Enum;

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
            'template_type' => [
                'required',
                'int',
                new Enum(TemplateTypeEnum::class)
            ],
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:' . Template::class . ',name'
            ],
            'image' => [
                'required',
                'file'
            ],
            'level' => [
                'required',
                'int',
                'min:1',
                'max:3',
            ]
        ];
    }
}
