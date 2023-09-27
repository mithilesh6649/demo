<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class HealthComplaint extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['user_selected_options'];

    public function getUserSelectedOptionsAttribute()
    {
        $userFoodAllergies = auth()->user()->foodAllergies->pluck('health_complaint_id')->toArray();
        $userFoodPreferences = auth()->user()->foodPreferences->pluck('food_preference_id')->toArray();

        return (in_array($this->id, $userFoodAllergies) || in_array($this->id, $userFoodPreferences)) ? true : false;
    }

    public function scopeStatus($qr)
    {
        return $qr->where('status', 1);
    }

    public function getFoodPreferencesAndFoodAllergies()
    {
        return HealthComplaint::whereIn('types', [4,5])->status()->get();
    }
}
