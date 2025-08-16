<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nis',
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'nama_ortu',
        'telepon_ortu',
        'email_ortu',
        'program_id',
        'kelas',
        'status',
        'tanggal_masuk',
        'foto',
        'catatan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function financeIncomes()
    {
        return $this->hasMany(FinanceIncome::class, 'student_name', 'nama_lengkap');
    }

    public function financeExpenses()
    {
        return $this->hasMany(FinanceExpense::class, 'student_name', 'nama_lengkap');
    }

    public function getJenisKelaminDisplayAttribute(): string
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getStatusDisplayAttribute(): string
    {
        $statuses = [
            'aktif' => 'Aktif',
            'nonaktif' => 'Nonaktif',
            'lulus' => 'Lulus',
            'pindah' => 'Pindah'
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }

    public function getUmurAttribute(): int
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->age : 0;
    }

    public function getLamaBelajarAttribute(): int
    {
        return $this->tanggal_masuk ? $this->tanggal_masuk->diffInYears(now()) : 0;
    }
}
