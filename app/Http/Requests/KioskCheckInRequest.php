<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KioskCheckInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'employee_id' => strtoupper(trim((string) $this->input('employee_id'))),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'string', 'max:50'],
        ];
    }
}