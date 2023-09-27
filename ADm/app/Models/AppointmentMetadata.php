<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentMetadata extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_time', 'appointment_id', 'status', 'start_time', 'end_time'];

    protected static function boot()
    {
        parent::boot();

        AppointmentMetadata::observe(new \App\Observers\AppointmentMetadataObserver);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
