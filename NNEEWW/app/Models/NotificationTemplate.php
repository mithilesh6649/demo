<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NotificationTemplate extends Model
{
    use HasFactory, SoftDeletes;

    public function Notification(){
        return $this->hasMany(Notification::class); //->where('notification_to_guard','users');
    }
}
