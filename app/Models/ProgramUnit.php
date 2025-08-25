<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramUnit extends Model
{
    use HasFactory;

    protected $table = 'program_units';

    protected $fillable = [
        'type',
        'sejarah',
        'visi',
        'misi_tujuan',
        'profil_ketua_program',
        'fasilitas',
    ];
}


