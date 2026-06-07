<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WaitingListUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'interest' => ['nullable', 'array'],
            'interest.*' => ['string'],
            'contacted' => ['boolean'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
