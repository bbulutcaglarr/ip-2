<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class


Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'campaign_id', 'amount', 'payment_method', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
