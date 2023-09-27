<?php

namespace App\Observers;

use App\Models\UserDailyDiet;
use App\Models\UserExercise;

class UserDailyExerciseCalorieburntObserver
{
    /**
     * Handle the UserExercise "created" event.
     *
     * @param  \App\Models\UserExercise  $userExercise
     * @return void
     */
    public function created(UserExercise $userExercise)
    {
        $this->updateUserDailyExerciseCalorieBurnt($userExercise);
    }

    /**
     * Handle the UserExercise "updated" event.
     *
     * @param  \App\Models\UserExercise  $userExercise
     * @return void
     */
    public function updated(UserExercise $userExercise)
    {
        $this->updateUserDailyExerciseCalorieBurnt($userExercise);
    }

    /**
     * Handle the UserExercise "deleted" event.
     *
     * @param  \App\Models\UserExercise  $userExercise
     * @return void
     */
    public function deleted(UserExercise $userExercise)
    {
        $exercise = $userExercise->exercise;

        if (UserExercise::where('user_daily_exercise_id', $userExercise->user_daily_exercise_id)->count() == 0) {

            $userExercise->dailyExerciseData->delete();

        } else {

            $userExercise->dailyExerciseData->decrement('total_calorie_burnt', round($exercise->calories_burnt * ($userExercise->getRawOriginal('duration') / 60), 3));
        }

        // if (request()->diet_plan_id) {

        //     $userDailyExercise = $userExercise->dailyExerciseData;
        //     $date = $userExercise->exercise_date;
        //     $userHealthStatus = auth()->user()->healthStatus;
        //     $totalRecommendedCaloriesPerday = round((int) $userHealthStatus->daily_calories_intake + ($exercise->calories_burnt * ($userExercise->duration / 60)), 3);

        //     if ($userDailyDiet = UserDailyDiet::where(['user_id' => auth()->id(), 'diet_plan_id' => request()->diet_plan_id, 'meal_date' => $date])->first()) {


        //         [$totalFat, $totalProtein, $totalCarbs] = $this->calculateNutrients($userHealthStatus, $totalRecommendedCaloriesPerday);

        //         $userDailyDiet->total_calorie_intake = $userDailyDiet->total_calorie_intake - round($exercise->calories_burnt * ($userExercise->getRawOriginal('duration') / 60), 3);

        //         $userDailyDiet->save();

        //     } else {

        //         $userDailyDiet = new UserDailyDiet;
        //         $userDailyDiet->user_id = auth()->id();
        //         $userDailyDiet->diet_plan_id = $userDailyExercise->diet_plan_id;
        //         $userDailyDiet->meal_date = $date;
        //     }
        // }
    }

    /**
     * Handle the UserExercise "restored" event.
     *
     * @param  \App\Models\UserExercise  $userExercise
     * @return void
     */
    public function restored(UserExercise $userExercise)
    {
        //
    }

    /**
     * Handle the UserExercise "force deleted" event.
     *
     * @param  \App\Models\UserExercise  $userExercise
     * @return void
     */
    public function forceDeleted(UserExercise $userExercise)
    {
        //
    }

    private function updateUserDailyExerciseCalorieBurnt($userExercise)
    {
        $exercise = $userExercise->exercise;

        if (request()->update_exercise == "true") {

            $userExercise->dailyExerciseData->decrement('total_calorie_burnt', round($exercise->calories_burnt * ($userExercise->getRawOriginal('duration') / 60), 3));
        }

        // $this->updateUserDailyDiet($userExercise, $exercise);
        $userExercise->dailyExerciseData->increment('total_calorie_burnt', round($exercise->calories_burnt * ($userExercise->duration / 60), 3));
    }

    private function updateUserDailyDiet($userExercise, $exercise)
    {
        $date = $userExercise->dailyExerciseData->exercise_date;
        $userDailyDiet = auth()->user()->currentDayDiet($date, request()->diet_plan_id)->first();
        $userHealthStatus = auth()->user()->healthStatus;

        if (is_null($userDailyDiet)) {

            $userDailyDiet = new UserDailyDiet;
            $userDailyDiet->user_id = auth()->id();
            $userDailyDiet->diet_plan_id = request()->diet_plan_id;
            $userDailyDiet->meal_date = $date;
            $totalRecommendedCaloriesPerday = round((int) $userHealthStatus->daily_calories_intake + ($exercise->calories_burnt * ($userExercise->duration / 60)), 3);

        } else {

            if (request()->update_exercise == "true") {

                $userDailyDiet->decrement('total_calorie_intake', round($exercise->calories_burnt * ($userExercise->getRawOriginal('duration') / 60), 3));
            }

            $totalRecommendedCaloriesPerday = round((int) $userDailyDiet->total_calorie_intake + (int) ($exercise->calories_burnt * ($userExercise->duration / 60)), 3);
        }

        $userDailyDiet->total_calorie_intake = $totalRecommendedCaloriesPerday;
        [$totalFat, $totalProtein, $totalCarbs] = $this->calculateNutrients($userHealthStatus, $totalRecommendedCaloriesPerday);
        $userDailyDiet->total_recommended_protein = $totalProtein;
        $userDailyDiet->total_recommended_carbs = $totalCarbs;
        $userDailyDiet->total_recommended_fat = $totalFat;
        $userDailyDiet->save();
    }

    private function calculateNutrients($userHealthStatus, $totalCaloriesPerDay)
    {
        $goal = \App\Models\MdDropdown::whereId($userHealthStatus->goal_id)->value('value');
        return calculateNutrientsIntakePerDay($totalCaloriesPerDay, $goal);
    }
}
