<?php

namespace App\Http\Requests\Languages;

use App\Http\Requests\Common\BaseRequest;
use App\Models\Language;
use Illuminate\Validation\Rule;

class UpdateLanguageRequest extends BaseRequest
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
                'max:100'
            ],
            'code' => [
                'required',
                'string',
                'min:2',
                'max:2',
                Rule::unique('languages', 'code')
                    ->ignore($this->language)
            ],
        ];
    }
}
