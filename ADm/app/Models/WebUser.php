<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebUser extends Model
{
    use HasFactory;

    public function metadata()
    {
        return $this->hasOne(WebUserMetadata::class);
    }

    public function specialization()
    {
        return $this->hasMany(WebUserSpecializationMap::class);
    }

    public function reviews()
    {
        return $this->hasOne(Review::class, 'review_to_id', 'id')->where('type', 2);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'invitee_id', 'id');
    }

    public function availabilityTime()
    {
        return $this->hasOne(WebUserWorkingHour::class);
    }

    public function getAvailabilityTime()
    {
        return WebUser::whereId(request()->consultant_id)->with(['availabilityTime' => function ($qr) {
                return $qr->where('days', now()->parse(request()->date)->dayOfWeek);
            },
            'appointments.metadata' => function ($qr) {
                return $qr->where('status', '!=', \DB::table('statuses')->where('slug', config('common.models.statuses.appointment_end'))->value('id'))
                    ->whereDate('appointment_time', request()->date);
            }])->first();
    }
}
