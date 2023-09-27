<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['notification_to', 'notification_template_id', 'notification_to_guard', 'notification_from', 'notification_from_guard', 'read'];

    protected $casts = ['read' => 'boolean'];

    public function getCreatedAtAttribute($createdAt)
    {
        return $this->attributes['created_at'] = now()->parse($createdAt)->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'notification_to', 'id');
    }

    public function notificationTemplate()
    {
        return $this->belongsTo(NotificationTemplate::class, 'notification_template_id', 'id');
    }
}
