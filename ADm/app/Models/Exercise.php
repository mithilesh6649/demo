<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['added_exercise_ids'];

    public function userExercise()
    {
        return $this->hasMany(UserExercise::class);
    }

    public function scopeStatus($qr)
    {
        return $qr->where('status', 1);
    }

    public function getAddedExerciseIdsAttribute()
    {
        return UserDailyExercise::getExerciseIdsBasedOnDate();
    }
}
