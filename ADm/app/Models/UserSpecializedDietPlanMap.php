<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSpecializedDietPlanMap extends Model
{
    use HasFactory;

    protected $fillable = ['user_diet_plan_subscription_id', 'diet_id', 'status'];

    protected $casts = ['status' => 'boolean'];
}
