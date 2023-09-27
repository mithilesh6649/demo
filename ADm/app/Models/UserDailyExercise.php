<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDailyExercise extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'exercise_date', 'total_calorie_burnt', 'web_user_id'];

    public function exercises()
    {
        return $this->hasMany(UserExercise::class);
    }

    public function createOrGetExercise($date)
    {
        return UserDailyExercise::firstOrCreate(['user_id' => auth()->id(), 'exercise_date' => $date]);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_calorie_burnt = 0;
        });
    }

    public function getExerciseIdsBasedOnDate($date = null)
    {
        $date = $date ?? now()->format('Y-m-d');

        return \DB::table('user_exercises')
            ->join('user_daily_exercises', 'user_daily_exercises.id', '=', 'user_exercises.user_daily_exercise_id')
            ->where('user_daily_exercises.user_id', auth()->id())
            ->whereDate('exercise_date', $date)
            ->pluck('user_exercises.exercise_id')
            ->toArray();
    }
}
