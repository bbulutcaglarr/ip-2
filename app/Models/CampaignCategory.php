<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignCategory extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'category_id'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
