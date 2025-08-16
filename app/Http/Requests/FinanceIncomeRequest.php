<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinanceIncomeRequest extends FormRequest
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
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:tunai,transfer,qris',
            'receipt_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
        ];
    }

    public function messages(): array
    {
        return [
            'student_name.required' => 'Nama siswa harus diisi',
            'class.required' => 'Kelas harus diisi',
            'amount.required' => 'Nominal harus diisi',
            'amount.numeric' => 'Nominal harus berupa angka',
            'amount.min' => 'Nominal tidak boleh negatif',
            'payment_method.required' => 'Metode pembayaran harus dipilih',
            'payment_date.required' => 'Tanggal pembayaran harus diisi',
            'status.required' => 'Status harus dipilih',
        ];
    }
}
