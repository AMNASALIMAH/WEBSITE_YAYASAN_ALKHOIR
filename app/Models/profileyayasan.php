<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profileyayasan extends Model
{
    use HasFactory;
    
    protected $table = 'profileyayasans';

    protected $fillable = [
        'visi',
        'misi',
        'sejarah',
        'telepon',
        'email',
        'alamat',
        'facebook',
        'twitter',
        'instagram',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot the model and add any global scopes or event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // Clear cache when model is updated or created
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('yayasan_profile_data');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('yayasan_profile_data');
        });
    }
}
