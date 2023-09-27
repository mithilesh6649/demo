<?php


/**
 * Function: uploadProfileImage
 * Functionality: It will extract the file
 *
 * @param string|base64 $file
 *
 * @return bool|string
 */
if (! function_exists('uploadProfileImage')) {

    function uploadProfileImage($file)
    {
        $imageName = config('common.profileImagePrefix').auth()->id().'.png';
        $image = str_replace('data:image/png;base64,', '', $file);
        $image = str_replace(' ', '+', $image);

        if(uploadFile(base64_decode($image), $imageName, config('common.user_profile_image_disk'))) {

            return $imageName;

        } else {

            return false;
        }
    }
}

/**
 * Function: uploadFile
 * Functionality: upload the file to the directory|disk
 *
 * @param $file
 * @param string $fileName
 * @param string $disk
 *
 * @return bool
 */
if (! function_exists('uploadFile')) {

    function uploadFile($file, $fileName, $disk)
    {
        try {
            Storage::disk($disk)->put($fileName, $file);

            return true;

        } catch (\Exception $e) {

            return false;
        }
    }
}

/**
 * Function: calculateBMR
 * Functionality: it will calculate BMR
 *
 * @param int $healthActivity
 * @param float $height
 * @param string $heightUnit
 * @param float $weight
 * @param string $weightUnit
 * @param int $age
 * @param string $gender
 * @param int $goalId
 * @param int|null $weeklyGoal
 *
 * @return string|int
 *
 */
if (! function_exists('calculateBMR')) {

    function calculateBMR($healthActivity, $height, $heightUnit, $weight, $weightUnit, $age, $gender, $goalId, $weeklyGoal = null)
    {
        $weightInKg = convertWeightIntoKG($weightUnit, $weight);
        $heightInCm = convertHeightIntoCM($heightUnit, $height);

        // 10 x weight (kg) + 6.25 x height (cm) – 5 x age (y) + 5 (kcal / day)         //For men
        // 10 x weight (kg) + 6.25 x height (cm) – 5 x age (y) -161 (kcal / day)        //For women

        $bmr = ($gender == "male" || "other") ? (10 * $weightInKg) + (6.25 * $heightInCm) - (5 * $age) + 5 : (10 * $weightInKg) + (6.25 * $heightInCm) - (5 * $age) - 161;

        $actualBMR = (int) round($bmr * (float) $healthActivity);

        $goal = \App\Models\MdDropdown::whereId($goalId)->value('value');

        $calorieManage = ($weeklyGoal == null) ? $actualBMR : config("common.calorie_manage.$weeklyGoal");

        switch ($goal) {

            case '1':
                $actualCaloriePerDay = (int) round($actualBMR - (int) $calorieManage);
                break;

            case '2':
                $actualCaloriePerDay = $calorieManage;
                break;

            case '3':
                $actualCaloriePerDay = (int) round($actualBMR + (float) $calorieManage);
                break;
        }

        [$totalFat, $totalProtein, $totalCarbs] = calculateNutrientsIntakePerDay($actualCaloriePerDay, $goal);

        return [$actualCaloriePerDay, $totalFat, $totalProtein, $totalCarbs];
    }
}

/**
 * Function: convertWeightIntoKG
 * Functionality: it will convert weight into kg
 *
 * @param string $weightUnit
 * @param float $weight
 *
 * @return int
 *
 */
if (! function_exists('convertWeightIntoKG')) {

    function convertWeightIntoKG($weightUnit, $weight)
    {
        switch ($weightUnit) {

            case 'kg':
                $weightInKg = $weight;
                break;

            case 'lbs':
                $weightInKg = number_format($weight * 0.453, 2, '.', ',');
                break;

            case 'st':
                $weightInKg = number_format($weight * 6.35, 2, '.', ',');
                break;

            default:
                $weightInKg = $weight;
                break;
        }

        return $weightInKg;
    }
}

/**
 * Function: convertHeightIntoCM
 * Functionality: it will convert height into cm
 *
 * @param string $heightUnit
 * @param float $height
 *
 * @return int
 *
 */
if (! function_exists('convertHeightIntoCM')) {

    function convertHeightIntoCM($heightUnit, $height)
    {
        switch ($heightUnit) {

            case 'cm':
                $heightInCm = $height;
                break;

            case 'ft/in':
                $height = explode(".", $height);
                $heightInInch = ($height[0] * 12) + ((isset($height[1])) ? $height[1] : 0);
                $heightInCm = number_format($heightInInch * 2.54, 2, '.', ',');
                break;

            default:
                $heightInCm = $height;
                break;
        }
        return $heightInCm;
    }
}


/**
 * Function: getBMIHealthStatus
 * Functionality: check with the bmi, what is the status of the health status
 *
 * @param int $bmi
 *
 * @return string
 */
if (! function_exists('getBMIHealthStatus')) {

    function getBMIHealthStatus($bmi): string
    {
        if ((float) $bmi <= 18.5 ) {

            $bmi_status = 'Underweight';

        } else if ((float) $bmi > 18.5 && (float) $bmi <= 24.9 ) {

            $bmi_status = 'Normal';

        } else if ((float) $bmi > 25.0 && (float) $bmi <= 29.9 ) {

            $bmi_status = 'Overweight';

        } else if ((float) $bmi >= 30.0) {

            $bmi_status = 'Obesity';
        }

        return $bmi_status;
    }
}

/**
 * Function: calculateNutrientsIntakePerDay
 * Functionality: to calculate per day nutrients intake. For converting the calorie
 * to nutrients intake per day. Here is the formula for that
 * Formula: 0.35 * 2200/9       // 0.35 ---> percent of nutrients per day
 *  2200 ----> total calorie intak per day
 *  9 -----> its for converting into gms
 *
 * Fat: has 9 calorie per gram so for calculating fat divide it by 9
 * Protein/Carbs: both has 4 calorie per gram so for calculating protein and carbs divide it by 4
 *
 * @param int $calories
 * @param int $goal
 *
 * @return array
 */
if (! function_exists('calculateNutrientsIntakePerDay')) {

    function calculateNutrientsIntakePerDay($calories, $goal) : array
    {
        if ($goal == 3 || $goal == 2) {

            $daily_carbs = (float) number_format(0.4 * (int) $calories/4, 2, '.', ',');
            $daily_protein = (float) number_format(0.3 * (int) $calories/4, 2, '.', ',');
            $daily_fat = (float) number_format(0.3 * (int) $calories/9, 2, '.', ',');

        } else {

            $daily_carbs = (float) number_format(0.4 * (int) $calories/4, 2, '.', ',');
            $daily_protein = (float) number_format(0.4 * (int) $calories/4, 2, '.', ',');
            $daily_fat = (float) number_format(0.2 * (int) $calories/9, 2, '.', ',');
        }

        return [$daily_fat, $daily_protein, $daily_carbs];
    }
}

/**
 * Function: calculateWeightReminderCronTime
 * Functionality: This will calculate cronTime for weight reminder
 *
 * @param object $data
 *
 * @return date object
 */
if (! function_exists('calculateWeightReminderCronTime')) {

    function calculateWeightReminderCronTime($data)
    {
        if ($data->selected_type == "day") {

            for ($i = 0; $i < 8; $i++) {

                if (now()->addDays($i)->englishDayOfWeek == $data->value) {

                    $cronTime = now()->addDays($i);
                }
            }
        } else {

            $currentDate = today()->format('d');
            $differenceDate = $data->value - $currentDate;

            $cronTime = now()->addDays($differenceDate);

            if ($cronTime < today()) {

                $cronTime = $cronTime->day($data->value)->addMonth();
            }
        }

        $cronTime->hour = '10';
        $cronTime->minute = '00';
        $cronTime->second = '00';

        return $cronTime;
    }
}

/**
 * Function: getCarbonTime
 * Functionality: convert 24 hours string time to carbon time
 *
 * @param string
 *
 * @return object
 */
if (! function_exists('getCarbonTime')) {

    function getCarbonTime($time)
    {
        return now()->createFromFormat('H:i', $time);
    }
}

/**
 * Function: splitTime
 * Functionality: This will split the time into equal time frame
 *
 * @param object $startTime
 * @param object $endTime
 * @param string $duration
 *
 * @return array
 */
if (! function_exists('splitTime')) {

    function SplitTime($startTime, $endTime, $duration = "60")
    {
        $ReturnArray = array ();// Define output
        $StartTime    = strtotime ($startTime); //Get Timestamp
        $EndTime      = strtotime ($endTime); //Get Timestamp

        $AddMins  = $duration * 60;

        while ($StartTime <= $EndTime) //Run loop
        {
            $ReturnArray[] = date ("Y-m-d G:i:s", $StartTime);
            $StartTime += $AddMins; //Endtime check
        }

        return $ReturnArray;
    }
}

/**
 * Function: splitTimeWithInterval
 * Functionality: split the time equally
 *
 * @param object $startDate
 * @param object $endDate
 * @param string $interval
 *
 * @return array
 */
if (! function_exists('splitTimeWithInterval')) {

    function splitTimeWithInterval($startDate, $endDate, $interval)
    {
        $differenceInMins = $startDate->diffInMinutes($endDate);

        if ($differenceInMins != 0 ) {

            $intervalMinutes = (int) round($differenceInMins/$interval);

            return $startDate->addMinutes($intervalMinutes);
        }

        return [null, null];
    }
}

/**
 * Function: calculateMealCalorieIntake
 * Functionality: Calculate the per meal calorie intake
 *
 * @param string $mealType
 * @param string $caloriePerDay
 *
 * @return array
 */
if (! function_exists('calculateMealCalorieIntake')) {

    function calculateMealCalorieIntake($mealType, int $caloriePerDay)
    {
        $caloriePerMeal = config("common.calorie_per_meal.$mealType");
        return [number_format(($caloriePerMeal['min']/100) * $caloriePerDay), number_format(($caloriePerMeal['max']/100) * $caloriePerDay)];
    }
}

/**
 * Function: calculateExpireTime
 * Functionality: It will calculate the time of plan expiring
 *
 * @param string $timePeriod
 *
 * @return array
 */
if (! function_exists('calculateExpireTime')) {

    function calculateExpireTime($timePeriod)
    {
        switch ($timePeriod) {

            case 'monthly':
                $expireTime = now()->addMonth();
                break;

            case 'quaterly':
                $expireTime = now()->addMonths(3);
                break;

            case 'yearly':
                $expireTime = now()->addYear();
                break;
            case 'twenty_years':
                $expireTime = now()->addYears(20);
                break;

            default:
                $expireTime = now()->addYears(5);
        }

        return $expireTime;
    }
}
