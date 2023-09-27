<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'payment_transation_id',
        'unique_ticket_id',
        'ticket_owner_guard',
        'title',
        'content',
        'status_id',
        'priority',
        'ticket_type',
        'user_report_id',
        'category',
        'ticket_assigned_to',
        'ticket_assigned_to_guard',
        'ticket_owner_id',
    ];

    protected $casts = ['ticket_type' => 'int'];

    public function ticketmessages()
    {
        return $this->hasOne(GroupChat::class);
    }

    public function createNewTicket($ticketType)
    {
        $ticket = new Ticket;

        $ticket->ticket_owner_id = auth()->id();
        $ticket->ticket_owner_guard = config('common.guards.users');
        $ticket->status_id = 10;
        $ticket->priority = (in_array($ticketType, config('common.models.tickets.priority_ticket_type'))) ? 'high' : 'low';
        $ticket->ticket_type = $ticketType;
        $ticket->category = config('common.models.tickets.category.'.$ticketType);

        $ticket->save();

        return $ticket->id;
    }

    public function alreadyExists($ticketType = null)
    {
        $ticketType = $ticketType ?? request()->ticket_type;

        return Ticket::where([
            'ticket_owner_id' => auth()->id(),
            'ticket_owner_guard' => config('common.guards.users'),
            'ticket_type' => $ticketType
            ])
            ->where('status_id', '!=', 11)
            ->latest()
            ->first();
    }

    public static function boot()
    {
        parent::boot();

        UserReport::observe(new \App\Observers\UserReportObserver);

        static::created(function($ticket) {
            $ticket->unique_ticket_id = "#GHX-TKT-$ticket->id";
            $ticket->save();
        });
    }
}
