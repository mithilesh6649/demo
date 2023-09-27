<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserDailyDiet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'diet_plan_id', 'diet_id', 'meal_date', 'total_breakfast_calorie_intake', 'total_lunch_calorie_intake', 'total_snack_calorie_intake', 'total_dinner_calorie_intake', 'meal_assigned_by_id', 'total_fat_intake', 'total_carbs_intake', 'total_protein_intake', 'total_calorie_intake', 'total_recommended_fat', 'total_recommended_carbs', 'total_recommended_protein'];

    protected $appends = ['total_calorie_intake_perday'];

    public function diets()
    {
        return $this->hasMany(UserDiet::class);
    }

    public function getTotalCalorieIntakePerdayAttribute()
    {
        $calorieBurnt = UserDailyExercise::where('user_id', auth()->id())->whereDate('exercise_date', $this->meal_date)->value('total_calorie_burnt');

        return $calorieBurnt + auth()->user()->healthStatus->daily_calories_intake;
        // return $this->total_breakfast_calorie_intake + $this->total_lunch_calorie_intake + $this->total_snack_calorie_intake + $this->total_dinner_calorie_intake;
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_breakfast_calorie_intake = 0;
            $model->total_lunch_calorie_intake = 0;
            $model->total_snack_calorie_intake = 0;
            $model->total_dinner_calorie_intake = 0;
            $model->total_fat_intake = 0;
            $model->total_carbs_intake = 0;
            $model->total_protein_intake = 0;
            $model->total_calorie_intake = 0;
            $model->total_recommended_fat = auth()->user()->healthStatus->total_fats_per_day;
            $model->total_recommended_carbs = auth()->user()->healthStatus->total_carbs_per_day;
            $model->total_recommended_protein = auth()->user()->healthStatus->total_protein_per_day;
        });
    }
}
