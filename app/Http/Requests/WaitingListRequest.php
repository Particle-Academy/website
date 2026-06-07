<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WaitingListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email'],
            'interest' => ['required', 'array', 'min:1'],
            'interest.*' => ['string'],
        ];
    }
}
