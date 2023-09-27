<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExercise extends Model
{
    use HasFactory;

    protected $fillable = ['user_daily_exercise_id', 'exercise_id', 'duration'];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id', 'id');
    }

    public function dailyExerciseData()
    {
        return $this->belongsTo(UserDailyExercise::class, 'user_daily_exercise_id', 'id');
    }

    public function saveExercise($dailyExerciseId)
    {
        $duration = (request()->duration) ? request()->duration : Exercise::whereId(request()->exercise_id)->value('duration_in_minutes');

        return UserExercise::updateOrCreate(['user_daily_exercise_id' => $dailyExerciseId, 'exercise_id' => request()->exercise_id], ['duration' => $duration]);
    }

    protected static function boot()
    {
        parent::boot();

        UserExercise::observe(new \App\Observers\UserDailyExerciseCalorieburntObserver);
    }
}
