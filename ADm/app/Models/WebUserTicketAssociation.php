<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebUserTicketAssociation extends Model
{
    use HasFactory;

    protected $table = 'ticket_assigned_to_web_users';

    protected $fillable = ['ticket_id', 'gena_health_user_id', 'gena_health_user_guard', 'ticket_assigned_date', 'ticket_revoke_date', 'is_blocked'];
}
