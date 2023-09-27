<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightReminder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'timepoint', 'type', 'cron_time', 'status'];

    protected $casts = [
        'cron_time' => 'datetime:Y-m-d H:00',
        'status' => 'boolean'
    ];
}
