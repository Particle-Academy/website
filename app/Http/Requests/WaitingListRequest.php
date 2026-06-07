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
            'email' => ['required', 'email'],
            'name' => ['nullable', 'string', 'min:2'],
            'interest' => ['nullable', 'array'],
            'interest.*' => ['string'],
        ];
    }
}
