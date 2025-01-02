<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reported_by', 'reported_user_id', 'reported_campaign_id', 'reason', 'status',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    public function reportedCampaign()
    {
        return $this->belongsTo(Campaign::class, 'reported_campaign_id');
    }
}
