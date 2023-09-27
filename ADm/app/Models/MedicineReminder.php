<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineReminder extends Model
{
    use HasFactory;

    protected $fillable = ['medicine_tracker_id', 'remind_time', 'cron_run'];

    protected $casts = ['remind_time' => 'datetime'];

    public function setRemindTimeAttribute($remindTime)
    {
        $this->attributes['remind_time'] = now()->parse($remindTime);
    }

    public function deleteMedicineDose($data)
    {
        MedicineReminder::whereId($data->dose_id)->delete();
    }
}
