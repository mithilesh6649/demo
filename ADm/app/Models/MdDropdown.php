<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdDropdown extends Model
{
    use HasFactory;

    public function weeklygoal()
    {
        return $this->hasOne(HealthStatus::class, 'id', 'goal_id');
    }

    public function medicineType()
    {
        return $this->hasOne(MedicineTracker::class, 'id', 'medicine_type_id');
    }

    public function medicineServingUnit()
    {
        return $this->hasOne(MedicineTracker::class, 'id', 'serving_unit_id');
    }

    public function notificationTemplate()
    {
        return $this->hasMany(NotificationTemplate::class, 'id', 'notification_type_id');
    }

    public function food()
    {
        return $this->hasOne(UserDiet::class, 'meal_type_id', 'id');
    }
}
