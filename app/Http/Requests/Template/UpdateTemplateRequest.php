<?php

namespace App\Http\Requests\Template;

use App\Http\Requests\Common\BaseRequest;
use App\Models\Field;
use App\Models\FieldType;
use Illuminate\Validation\Rule;

class UpdateTemplateRequest extends BaseRequest
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
                Rule::unique('templates', 'name')
                    ->ignore($this->template)
            ],
            'fields' => [
                'array'
            ],
            'fields.*.id' => [
                'int',
                'exists:' . Field::class . ',id'
            ],
            'fields.*.field_type_id' => [
                'int',
                'exists:' . FieldType::class . ',id'
            ],
            'fields.*.label' => [
                'string',
                'max:150'
            ],
            'fields.*.name' => [
                'string',
                'max:150'
            ],
        ];
    }
}
