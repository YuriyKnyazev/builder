<?php

namespace App\Http\Requests\Common;

/**
 * @property string model
 * @property array sort
 */

class SortRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'model' => 'required|string',
            'sort' => 'required|array',
            'sort.*' => 'int',
        ];
    }
}
