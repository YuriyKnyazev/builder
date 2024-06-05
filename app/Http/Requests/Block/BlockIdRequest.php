<?php

namespace App\Http\Requests\Block;

use App\Http\Requests\Common\BaseRequest;
use App\Models\Block;
use App\Models\Page;

class BlockIdRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'blockId' => [
                'required',
                'int',
                'exists:' . Block::class . ',id'
            ],
        ];
    }
}
