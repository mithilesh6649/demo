<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['group_chat_id', 'sender_id',  'message', 'message_type', 'sender_guard'];

    protected $appends = ['is_sender_nutritionist'];

    protected function getIsSenderNutritionistAttribute()
    {
        return ($this->sender_guard == config('common.guards.web_users')) ? true : false;
    }

    public function scopeOrderByTimeAttribute($qr)
    {
        return $qr->orderBy('created_at', 'DESC');
    }

    public function createDummyMessage($groupChatId, $ticketType = null)
    {
        $messageSlug = $ticketType ?? request()->ticket_type;

        $count = 0;

        foreach (config('common.chat_static_message.organ_health') as $data) {

            $message = new Message;

            $message->group_chat_id = $groupChatId;
            $message->message_type = $data['message_type'];

            if ($count == 1) {

                $message->message = Message::getMessage($messageSlug);

            } else {

                $message->message = $data['message'];
            }

            $message->save();
            $count ++;
        }
    }

    private static function getMessage($messageSlug)
    {
        if ($messageSlug == config('common.models.tickets.ticket_type.report') || $messageSlug == config('common.models.tickets.ticket_type.organ_consultation_without_report') || $messageSlug == config('common.models.tickets.ticket_type.dna_test_support')) {

            $messageSlug = config('common.models.tickets.ticket_type.report');

        } else if ($messageSlug == config('common.models.tickets.ticket_type.support') || $messageSlug == config('common.models.tickets.ticket_type.diet_plan') || $messageSlug == config('common.models.tickets.ticket_type.consultation') || $messageSlug == config('common.models.tickets.ticket_type.test')) {

            $message = 'How Can we help you?';

        } else {

            $messageSlug = $messageSlug;
        }

        if (!isset($message)) {

            $message = MdDropdown::where(['module' => 'your_health_guide_message', 'slug' => $messageSlug])->pluck('value')->first();
        }

        return $message;
    }
}
