<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignTag extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'tag_id'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
