<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceIncome extends Model
{
    use HasFactory;

    protected $table = 'finance_income';
    
    protected $fillable = [
        'student_name',
        'class',
        'amount',
        'payment_method',
        'receipt_number',
        'notes',
        'payment_date',
        'status',
        'created_by'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];


}
