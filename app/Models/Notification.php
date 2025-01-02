<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'message', 'read', 'updated_at', 'created_at', 'notifiable_type'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($notification) {
            if (empty($notification->notifiable_type)) {
                $notification->notifiable_type = 'DefaultType'; // veya dinamik bir değer
            }
        });
    }
    /**
     * Bildirim ile ilişkilendirilmiş kullanıcıyı al.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function notifiable()
    {
        return $this->morphTo();
    }
}
