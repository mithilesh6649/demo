<?php

namespace App\Http\Traits;

trait HealthStatusTrait {

    /**
     * Function: calculateDesiredWeightDate
     * Functionality: calculate the exact day when the user can get his/her
     * desired Weight
     *
     * @param float $weightInKg
     * @param float $goalWeightInKg
     * @param int $weeklyGoal|null
     */
    public function calculateDesiredWeightDate($weightInKg, $goalWeightInKg, $weeklyGoal)
    {
        $weightGainLose = abs ($weightInKg - $goalWeightInKg);

        $weeks = (int) round($weightGainLose/config("common.weight_gain_or_lose_in_kg.$weeklyGoal"), 1);

        //convert the weeks into days
        return [now()->addDays($weeks * 7)->isoFormat('Do MMMM'), $weightGainLose];
    }
}
