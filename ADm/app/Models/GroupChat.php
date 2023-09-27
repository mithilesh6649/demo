<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'chat_unqiue_id', 'is_chat_ended'];

    protected $casts = ['is_chat_ended' => 'boolean'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function groupUsers()
    {
        return $this->hasMany(GroupChatUser::class);
    }

    public function checkNutritionistMessaged($ticket)
    {
        $ifMessageExists = $ticket->ticketmessages->messages->where('sender_id', '!=', auth()->id())->where('sender_guard', '!=', config('common.guards.users'))->first();

        return ($ifMessageExists) ? true : false;

    }

    public function createChatGroup($ticketId)
    {
        $groupChat = new GroupChat;

        $groupChat->ticket_id = $ticketId;

        if ($groupChat->save()) {

            $groupChatUser = new GroupChatUser;
            Message::createDummyMessage($groupChat->id);

            $groupChatUser->group_chat_id = $groupChat->id;
            $groupChatUser->gena_health_user_id = auth()->id();
            $groupChatUser->gena_health_user_guard = config('common.guards.users');
            $groupChatUser->save();
        }
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($groupChat) {
            $groupChat->chat_unqiue_id = "#GHX-CHT-TKT-$groupChat->id";
            $groupChat->save();
        });
    }
}
