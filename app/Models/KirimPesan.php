<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KirimPesan extends Model
{
    protected $table = 'kirim_pesans';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'no_hp',
        'email',
        'pesan',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
