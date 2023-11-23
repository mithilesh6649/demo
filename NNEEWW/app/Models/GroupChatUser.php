<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChatUser extends Model
{
    use HasFactory;

  public function groupChat()
    {
        return $this->hasOne(GroupChat::class,'id','group_chat_id');
    }
}
