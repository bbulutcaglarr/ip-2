<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'raised_amount', 'goal_amount', 'start_date', 'end_date', 'user_id','total_donations'
    ];
    public function usersWhoSaved()
    {
        return $this->belongsToMany(User::class, 'saved_campaigns');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function updates()
    {
        return $this->hasMany(CampaignUpdate::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'campaign_tags');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'campaign_categories');
    }
    public function scopePopular($query)
    {
        // Örneğin, bağış miktarına göre sıralama
        return $query->orderBy('amount', 'desc');
    }
    protected $dates = [
        'end_date',
    ];
}
