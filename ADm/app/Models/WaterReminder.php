<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterReminder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'interval_time', 'start_time', 'end_time', 'cron_time', 'actual_repetition_count', 'repetition_count', 'status', 'reminder_type', 'add_time_to_cron_time'];

    protected $casts = [
        'status' => 'boolean',
        'end_time' => 'datetime',
        'start_time' => 'datetime',
        'cron_time' => 'datetime',
        'add_time_to_cron_time' => 'datetime',
    ];

    public function updateWaterReminder($data)
    {
        WaterReminder::updateOrCreate(['user_id' => auth()->id()], $data);
    }
}
