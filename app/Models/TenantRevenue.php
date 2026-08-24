<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantRevenue extends Model
{
    protected $fillable = [
        'revenue_date',
        'merchant_name',
        'amount',
    ];

    protected $casts = [
        'revenue_date' => 'date',
        'amount' => 'decimal:2',
    ];
}
