<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterTracker extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'glass_count', 'unit'];

    protected $appends = ['goal'];

    public function getGoalAttribute()
    {
        return $this->attributes['goal'] = auth()->user()->metadata->water_glass_goal;
    }
}
