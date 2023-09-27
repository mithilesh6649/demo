<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'invitee_id'];

    public function scheduledAppointment()
    {
        return $this->hasOne(AppointmentMetadata::class)->where('status', 2);
    }

    public function requestedAppointment()
    {
        return $this->hasOne(AppointmentMetadata::class)->where('status', 1);
    }

    public function metadata()
    {
        return $this->hasMany(AppointmentMetadata::class);
    }

    public function inviteeUser()
    {
        return $this->belongsTo(WebUser::class, 'invitee_id', 'id');
    }

    public function appUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function alreadyScheduled($consultantId, $bookingDate, $timeSlot)
    {
        $startTime = $timeSlot[0];
        $endTime = $timeSlot[1];

        return AppointmentMetadata::join('appointments', 'appointments.id', 'appointment_metadata.appointment_id')
            ->where('appointments.invitee_id', $consultantId)
            ->whereDate('appointment_metadata.appointment_time', $bookingDate)
            ->where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->exists();
    }
}
