<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinanceSppSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'class_level' => 'required|string|max:50',
            'monthly_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'class_level.required' => 'Level kelas harus diisi',
            'monthly_amount.required' => 'Nominal bulanan harus diisi',
            'monthly_amount.numeric' => 'Nominal bulanan harus berupa angka',
            'monthly_amount.min' => 'Nominal bulanan tidak boleh negatif',
        ];
    }
}
