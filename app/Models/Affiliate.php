<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $fillable = [
        'user_id',
        'referral_code',
        'referral_count',
        'commission_rate',
        'total_earnings',
        'available_balance',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'user_id');
    }
} 