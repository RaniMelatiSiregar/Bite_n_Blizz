<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'expiration_date',
        'is_active'
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'is_active' => 'boolean',
        'discount' => 'float'
    ];
}
