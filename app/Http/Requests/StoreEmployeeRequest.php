<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'office' => trim((string) $this->input('office')),
            'employee_id' => strtoupper(trim((string) $this->input('employee_id'))),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'office' => ['nullable', 'string', 'max:255'],
            'employee_id' => ['required', 'string', 'max:50', Rule::unique('employees', 'employee_id')],
        ];
    }
}