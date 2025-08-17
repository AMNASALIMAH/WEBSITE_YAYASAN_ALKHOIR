<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'nis' => 'required|string|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string|max:100',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string|max:500',
            'nama_ortu' => 'required|string|max:255',
            'telepon_ortu' => 'required|string|max:20',
            'email_ortu' => 'nullable|email|max:255',
            'program_id' => 'required|exists:programs,id',
            'kelas' => 'required|string|max:20',
            'status' => 'required|in:aktif,nonaktif,lulus,pindah',
            'tanggal_masuk' => 'required|date|before_or_equal:today',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catatan' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nis.required' => 'NIS harus diisi',
            'nis.unique' => 'NIS sudah digunakan',
            'nis.max' => 'NIS maksimal 20 karakter',
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 255 karakter',
            'nama_panggilan.max' => 'Nama panggilan maksimal 100 karakter',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.before' => 'Tanggal lahir tidak boleh di masa depan',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',
            'agama.required' => 'Agama harus diisi',
            'agama.max' => 'Agama maksimal 50 karakter',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.max' => 'Alamat maksimal 500 karakter',
            'nama_ortu.required' => 'Nama orang tua harus diisi',
            'nama_ortu.max' => 'Nama orang tua maksimal 255 karakter',
            'telepon_ortu.required' => 'Telepon orang tua harus diisi',
            'telepon_ortu.max' => 'Telepon orang tua maksimal 20 karakter',
            'email_ortu.email' => 'Email orang tua tidak valid',
            'email_ortu.max' => 'Email orang tua maksimal 255 karakter',
            'program_id.required' => 'Program harus dipilih',
            'program_id.exists' => 'Program tidak valid',
            'kelas.required' => 'Kelas harus diisi',
            'kelas.max' => 'Kelas maksimal 20 karakter',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
            'tanggal_masuk.required' => 'Tanggal masuk harus diisi',
            'tanggal_masuk.before_or_equal' => 'Tanggal masuk tidak boleh di masa depan',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
            'catatan.max' => 'Catatan maksimal 1000 karakter',
        ];
    }
}
