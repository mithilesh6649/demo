<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDiet extends Model
{
    use HasFactory;

    protected $fillable = ['user_daily_diet_id', 'food_id', 'meal_type_id', 'quantity', 'is_tracked'];

    protected $casts = ['is_tracked' => 'boolean'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function mealType()
    {
        return $this->belongsTo(MdDropdown::class, 'meal_type_id', 'id');
    }

    public function saveUserDiet($foodId, $userDailyDietId)
    {
        if (request()->food_replace) {

            $userDiet = UserDiet::where(['user_daily_diet_id' => $userDailyDietId, 'food_id' => request()->food_replace_id])->first();
            $userDiet->food_id = $foodId;
            return $userDiet->save();
        }

        return UserDiet::firstOrCreate([
            'user_daily_diet_id' => $userDailyDietId,
            'food_id' =>$foodId],
            [
            'meal_type_id' => MdDropdown::where(['slug' => request()->meal_type, 'module' => 'meals'])->value('id'),
            'quantity' => request()->serving_size ?? 1
        ]);
    }

    public function dailyDiet()
    {
        return $this->belongsTo(UserDailyDiet::class, 'user_daily_diet_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        UserDiet::observe(new \App\Observers\UserDailyMealCalorieIntakeObserver);
    }
}
