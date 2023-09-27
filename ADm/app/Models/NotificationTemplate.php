<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['notification_type_id', 'notification_image', 'title', 'body', 'notification_type', 'status'];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function notificationType()
    {
        return $this->belongsTo(MdDropdown::class, 'notification_type_id', 'id');
    }
}
