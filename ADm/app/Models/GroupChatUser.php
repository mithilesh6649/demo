<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChatUser extends Model
{
    use HasFactory;

    protected $fillable = ['group_chat_id', 'gena_health_user_id', 'gena_health_user_guard', 'is_blocked'];

    protected $casts = ['is_blocked' => 'boolean'];
}
