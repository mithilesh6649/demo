<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepReminder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cron_time'];

    protected $casts = ['cron_time' => 'datetime'];

    protected $appends = ['front_cron_time'];

    public function getFrontCronTimeAttribute()
    {
        return now()->parse($this->cron_time)->format('H:i');
    }
}
