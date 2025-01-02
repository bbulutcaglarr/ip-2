<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id', 'transaction_date', 'transaction_status', 'payment_reference',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
