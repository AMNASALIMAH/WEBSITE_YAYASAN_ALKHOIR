<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinanceExpenseRequest extends FormRequest
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
            'expense_title' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|in:operasional,gaji,utilitas,maintenance,pendidikan,lainnya',
            'expense_date' => 'required|date',
            'receipt_number' => 'nullable|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'approved_by' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'expense_title.required' => 'Judul pengeluaran harus diisi',
            'description.required' => 'Deskripsi harus diisi',
            'amount.required' => 'Nominal harus diisi',
            'amount.numeric' => 'Nominal harus berupa angka',
            'amount.min' => 'Nominal tidak boleh negatif',
            'category.required' => 'Kategori harus dipilih',
            'expense_date.required' => 'Tanggal pengeluaran harus diisi',
            'status.required' => 'Status harus dipilih',
        ];
    }
}
