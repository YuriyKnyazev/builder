<?php

namespace App\Http\Requests\Menu;

use App\Http\Requests\Common\BaseRequest;

class UpdateMenuRequest extends BaseRequest
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
                'max:50'
            ],
        ];
    }
}
