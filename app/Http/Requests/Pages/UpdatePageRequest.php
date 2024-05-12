<?php

namespace App\Http\Requests\Pages;

use App\Models\Page;
use Illuminate\Validation\Rule;

class UpdatePageRequest extends StorePageRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['path'] = [
            'required',
            'string',
            'max:250',
            Rule::unique('pages', 'path')
            ->ignore($this->page),
        ];
        return $rules;
    }
}
