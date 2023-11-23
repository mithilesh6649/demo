<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class,'id','ticket_id');
    }

    public function groupUsers()
    {
        return $this->hasMany(GroupChatUser::class);
    }
}
