<?php

namespace Zvermafia\TransliterationLaravel\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransliteratorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text' => [
                'required',
            ],
            'to_cyrillic' => [
                'required',
                'boolean',
            ],
        ];
    }
}
