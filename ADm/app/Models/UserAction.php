<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'user_guard', 'status_id', 'action_by', 'action_reason', 'action_time'];
}
