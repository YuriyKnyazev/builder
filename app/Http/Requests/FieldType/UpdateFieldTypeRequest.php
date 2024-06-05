<?php

namespace App\Http\Requests\FieldType;

use App\Http\Requests\Common\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateFieldTypeRequest extends BaseRequest
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
                Rule::unique('field_types', 'name')
                    ->ignore($this->fieldType)
            ],
        ];
    }
}
