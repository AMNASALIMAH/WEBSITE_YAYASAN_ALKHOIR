<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceSppSetting extends Model
{
    use HasFactory;

    protected $table = 'finance_spp_settings';
    
    protected $fillable = [
        'class_level',
        'monthly_amount',
        'description',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'monthly_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
