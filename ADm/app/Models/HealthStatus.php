<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class HealthStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'health_activity',
        'target_weight_unit',
        'daily_calories_intake',
        'bmi_status',
        'weight_difference',
        'target_weight_completion_date',
        'total_protein_per_day',
        'total_carbs_per_day',
        'total_fats_per_day',
        'target_weight',
        'height_unit',
        'weight_unit',
        'height',
        'disease_id',
        'bio',
        'weight',
        'address',
        'weekly_goals',
        'goal_id',
        'city',
        'age',
        'image',
        'bmi',
        'recommended_breakfast_min_calorie_intake',
        'recommended_breakfast__max_calorie_intake',
        'recommended_lunch_min_calorie_intake',
        'recommended_lunch_max_calorie_intake',
        'recommended_snacks_min_calorie_intake',
        'recommended_snacks_max_calorie_intake',
        'recommended_dinner_min_calorie_intake',
        'recommended_dinner_max_calorie_intake'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function weeklyGoal()
    {
        return $this->belongsTo(MdDropdown::class, 'goal_id', 'id');
    }

    public function getHealthActivity($id)
    {
        return MdDropdown::where(['slug' => 'health_activity', 'id' => $id])->value('value');
    }

    public function getWeeklyGoal($id)
    {
        return MdDropdown::where(['slug' => 'weekly_goals', 'id' => $id])->value('value');
    }
    
    public function getHealthActivityLabel($id){
        return MdDropdown::where(['slug' => 'health_activity', 'id' => $id])->value('name');
    }

     public function getWeeklyGoalLabel($id)
    {
        return ltrim(str_ireplace("Loose", "", MdDropdown::where(['slug' => 'weekly_goals', 'id' => $id])->value('name')));
    } 
 
     public function getHealthActivityId($value)
    {
        return MdDropdown::where(['slug' => 'health_activity', 'value' => $value])->value('id');
    }

    public function getWeeklyGoalId($value)
    {
        return MdDropdown::where(['slug' => 'weekly_goals', 'value' => $value])->value('id');
    }

    protected static function boot()
    {
        parent::boot();

        HealthStatus::observe(new \App\Observers\HealthStatusObserver);
    }
}
