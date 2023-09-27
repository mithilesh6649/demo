<?php

namespace App\Observers;

use App\Models\UserDiet;

class UserDailyMealCalorieIntakeObserver
{
    /**
     * Handle the UserDiet "created" event.
     *
     * @param  \App\Models\UserDiet  $userDiet
     * @return void
     */
    public function created(UserDiet $userDiet)
    {
        $this->updateUserDailyMealCalorieIntake($userDiet);
    }

    /**
     * Handle the UserDiet "updated" event.
     *
     * @param  \App\Models\UserDiet  $userDiet
     * @return void
     */
    public function updated(UserDiet $userDiet)
    {
        $this->updateUserDailyMealCalorieIntake($userDiet);
    }

    /**
     * Handle the UserDiet "deleted" event.
     *
     * @param  \App\Models\UserDiet  $userDiet
     * @return void
     */
    public function deleted(UserDiet $userDiet)
    {
        //
    }

    /**
     * Handle the UserDiet "restored" event.
     *
     * @param  \App\Models\UserDiet  $userDiet
     * @return void
     */
    public function restored(UserDiet $userDiet)
    {
        //
    }

    /**
     * Handle the UserDiet "force deleted" event.
     *
     * @param  \App\Models\UserDiet  $userDiet
     * @return void
     */
    public function forceDeleted(UserDiet $userDiet)
    {
        //
    }

    private function updateUserDailyMealCalorieIntake($userDiet)
    {
        switch ($userDiet->mealType->slug) {

            case config('common.meals_slug_name.breakfast'):
                $columnName = 'total_breakfast_calorie_intake';
                break;

            case config('common.meals_slug_name.lunch'):
                $columnName = 'total_lunch_calorie_intake';
                break;

            case config('common.meals_slug_name.snacks'):
                $columnName = 'total_snack_calorie_intake';
                break;

            case config('common.meals_slug_name.dinner'):
                $columnName = 'total_dinner_calorie_intake';
                break;
        }

        if ($userDiet->dailyDiet->diet_plan_id == 1) {

            if (request()->food_replace) {

                $foodInfo = \App\Models\Food::find(request()->food_replace_id);

                $userDiet->dailyDiet->decrement('total_fat_intake', $foodInfo->total_fat ?? 0);
                $userDiet->dailyDiet->decrement('total_carbs_intake', $foodInfo->total_carbohydrate ?? 0);
                $userDiet->dailyDiet->decrement('total_protein_intake', $foodInfo->protein ?? 0);
                $userDiet->dailyDiet->decrement('total_calorie_intake', $foodInfo->calories ?? 0);
                $userDiet->dailyDiet->decrement($columnName, $foodInfo->calories);
            }

            $userDiet->dailyDiet->increment('total_fat_intake', $userDiet->food->total_fat ?? 0);
            $userDiet->dailyDiet->increment('total_carbs_intake', $userDiet->food->total_carbohydrate ?? 0);
            $userDiet->dailyDiet->increment('total_protein_intake', $userDiet->food->protein ?? 0);
            $userDiet->dailyDiet->increment($columnName, $userDiet->food->calories);
            $userDiet->dailyDiet->increment('total_calorie_intake', $userDiet->food->calories);

        } else {

            if (request()->has('track')) {

                if ((bool) request()->track) {

                    $userDiet->dailyDiet->increment('total_fat_intake', $userDiet->food->total_fat ?? 0);
                    $userDiet->dailyDiet->increment('total_carbs_intake', $userDiet->food->total_carbohydrate ?? 0);
                    $userDiet->dailyDiet->increment('total_protein_intake', $userDiet->food->protein ?? 0);
                    $userDiet->dailyDiet->increment('total_calorie_intake', $userDiet->food->calories);
                    $userDiet->dailyDiet->increment($columnName, $userDiet->food->calories);

                } else if (request()->food_replace) {

                    $foodInfo = \App\Models\Food::find(request()->food_replace_id);

                    $userDiet->dailyDiet->decrement('total_fat_intake', $foodInfo->total_fat ?? 0);
                    $userDiet->dailyDiet->decrement('total_carbs_intake', $foodInfo->food->total_carbohydrate ?? 0);
                    $userDiet->dailyDiet->decrement('total_protein_intake', $foodInfo->food->protein ?? 0);
                    $userDiet->dailyDiet->decrement($columnName, $foodInfo->calories);
                    $userDiet->dailyDiet->decrement('total_calorie_intake', $foodInfo->calories);

                    $userDiet->dailyDiet->increment('total_fat_intake', $userDiet->food->total_fat ?? 0);
                    $userDiet->dailyDiet->increment('total_carbs_intake', $userDiet->food->total_carbohydrate ?? 0);
                    $userDiet->dailyDiet->increment('total_protein_intake', $userDiet->food->protein ?? 0);
                    $userDiet->dailyDiet->increment($columnName, $userDiet->food->calories);
                    $userDiet->dailyDiet->increment('total_calorie_intake', $userDiet->food->calories);

                } else {

                    $userDiet->dailyDiet->decrement('total_fat_intake', $userDiet->food->total_fat ?? 0);
                    $userDiet->dailyDiet->decrement('total_carbs_intake', $userDiet->food->total_carbohydrate ?? 0);
                    $userDiet->dailyDiet->decrement('total_protein_intake', $userDiet->food->protein ?? 0);
                    $userDiet->dailyDiet->decrement($columnName, $userDiet->food->calories);
                    $userDiet->dailyDiet->decrement('total_calorie_intake', $userDiet->food->calories);
                }
            }
        }
    }
}
