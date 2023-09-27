<?php

namespace App\Services;

use App\Http\Traits\HealthStatusTrait;
use App\Services\SendMobileOTP;
use App\Models\Reverification;
use App\Jobs\SendMailToUser;
use App\Models\HealthStatus;
use Illuminate\Support\Str;
use App\Models\User;


class UserServices
{
    use HealthStatusTrait;

    static $errorResponse = [
        'status' => 400,
        'success' => false,
        'message' => 'Something went wrong',
        'error' => true
    ];

    /**
     * Function: userProfile
     * Functionality: provide the user basic information
     * param : true :- means chacking  api call from :- user/profile
     * @return array
     */
    public function userProfile(): array
    {
        return [ 'status' => 200, 'success' => true, 'data' => auth()->user()->userProfile(), 'error' => false];
    }

    /**
     * Function: manageNotification
     * Functionality: Manage the email notifications & push notifications
     *
     * @param array $request
     *
     * @return array
     */
    public function manageNotification(array $request): array
    {
        $user = auth()->user();
        $column = ($request['notification_type'] == "phone") ? 'push_notification' : 'email_notification';
        $user->{$column} = $request['value'];

        if ($user->save()) {

            return [ 'status' => 200, 'success' => true, 'message' => 'Notification successfully updated', 'error' => false];
        }

        return $this->errorResponse;
    }

    /**
     * Function: updateProfile
     * Functionality: update the user profile
     * Function Called: This function calls the helper functions uploadProfileImage()
     *
     * @param array $request
     * @return array
     */
    public function updateProfile(array $request): array
    {

        $user = auth()->user();
        $userTableRecord = false;

        if (isset($request['gender'])) {

            $user->gender = $request['gender'];
            $userTableRecord = true;
        }

        if (isset($request['name'])) {

            $user->name = $request['name'];
            $userTableRecord = true;
        }

        if ($userTableRecord) { $user->save(); }

        if (isset($request['bio'])) {

            $modifyData['bio'] = $request['bio'];

        } elseif (isset($request['profile_image'])){

            if($imageName = uploadProfileImage($request['profile_image'])) {

                $modifyData['image'] = \Storage::disk(config('common.user_profile_image_disk'))->url($imageName);

            } else {

                return [
                    'status' => 400,
                    'success' => false,
                    'message' => 'Image not uploaded, Something went wrong!',
                    'error' => true,
                ];
            }

        } elseif(isset($request['address'])) {

            $modifyData['address'] = $request['address'];

        } else {

            $modifyData = [
                'target_weight_unit' => isset($request['target_weight_unit']) ? $request['target_weight_unit'] : null,
               // 'health_activity' => isset($request['health_activity']) ? $request['health_activity'] : null,
                'health_activity' => isset($request['health_activity']) ? $user->healthStatus->getHealthActivityId($request['health_activity']) : null,
                'target_weight' => isset($request['target_weight']) ? $request['target_weight'] : null,
                // 'weekly_goals' => isset($request['weekly_goals']) ? $request['weekly_goals'] : null,
                'weekly_goals' => isset($request['weekly_goals']) ? $user->healthStatus->getWeeklyGoalId($request['weekly_goals']) : null,
                'height_unit' => isset($request['height_unit']) ? $request['height_unit'] : null,
                'weight_unit' => isset($request['weight_unit']) ? $request['weight_unit'] : null,
                'height' => isset($request['height']) ? $request['height'] : null,
                'weight' => isset($request['weight']) ? $request['weight'] : null,
                'gender' => isset($request['gender']) ? $request['gender'] : null,
                'city' => isset($request['city']) ? $request['city'] : null,
                'age' => isset($request['age']) ? $request['age'] : null,
            ];
        }
   //dd($modifyData);
        HealthStatus::updateOrCreate([
            'user_id' => auth()->id()
        ], $modifyData);

        return [ 'status' => 200, 'success' => true, 'message' => 'Profile updated successfully', 'data' => auth()->user()->userProfile(), 'error' => false];
    }

    /**
     * Function: updateProfileEmailOrPhone
     * Functionality: update the user email or user phone number through verification
     *
     * @param array $data
     *
     * @return array
     */
    public function updateProfileEmailOrPhone(array $data): array
    {
        $otpData['otp'] = rand(1000, 9999);
        $otpData['token'] = Str::random(40);
        $otpData['new_username'] = (isset($data['email'])) ? $data['email'] : $data['phone_number'];
        $otpData['country_code'] = (isset($data['phone_number'])) ? $data['country_code'] : null;
        $columnKey = array_search($otpData['new_username'], $data);
        $otpData['expiry_at'] = now()->addDays(config('common.email_verification_expiry_time_in_days'));

        if (auth()->user()->{$columnKey} == $otpData['new_username']) {

            $message = "You cannot changed your ".Str::headline($columnKey);

        } else if (User::where($columnKey, $otpData['new_username'])->where('id', '!=', auth()->id())->exists()) {

            $message = Str::headline($columnKey)." already exists";

        } else {

            $verfication = Reverification::updateOrCreate([
                'user_id' => auth()->id(),
            ], $otpData);

            switch ($data['update_type']) {

                case 'phone':

                $otpData['otp_message_slug'] = config('common.phone_otp_message_slug.user_change_phone_number');
                $otpData['phone_number'] = '+'.$data['country_code'].$data['phone_number'];
                $message = (SendMobileOTP::sendOTPToPhoneNumber($otpData)) ? "OTP Successfully sent" : "Something went wrong";

                break;

                case 'email':

                $emailOTPData = [
                    'email' => $otpData['new_username'],
                    'name' => auth()->user()->name,
                    'userId' => auth()->id(),
                    'otp' => $otpData['otp']
                ];

                dispatch(new SendMailToUser($emailOTPData));

                $message = "Email successfully sent";
                break;
            }

            return [
                'status' => 200,
                'success' => true,
                'message' => $message,
                'data' => [
                    'token' => $verfication->token,
                    'new'.$columnKey => $otpData['new_username']
                ],
                'error' => false,
            ];
        }


        return [ 'status' => 400, 'success' => false, 'message' => $message, 'error' => true];
    }

    /**
     * Function: saveHealthStatusInput
     * Functionality: it will save the input of user related to health status
     *
     * @param object $data
     *
     * @return array
     */
    public function saveHealthStatusInput($request)
    {
        $responseData = [];

        if ($request->has('goal')) {

            $data['goal_id'] = \App\Models\MdDropdown::where(['slug' => 'goal', 'value' => $request->goal])->value('id');
        }

        if ($request->has('health_activity')) {

            $data['health_activity'] = \App\Models\MdDropdown::where(['slug' => 'health_activity', 'value' => $request->health_activity])->value('id');
        }

        if ($request->has('gender')) {

            $user = auth()->user();
            $user->gender = $request->gender;
            $user->save();
        }

        if ($request->has('age')) {

            $data['age'] = $request->age;
        }

        if ($request->has('height') && $request->has('weight')) {

            $data['height'] = $request->height;
            $data['height_unit'] = $request->height_unit;
            $data['weight'] = $request->weight;
            $data['weight_unit'] = $request->weight_unit;
            [$heightInCm, $data['bmi']] = $this->calculateBMI($request);

            auth()->user()->healthStatus()->updateOrCreate(['user_id' => auth()->id()], $data);

            if (auth()->user()->healthStatus->weeklyGoal->value == 2) {

                [$responseData['daily_calorie_intake'], $data['total_fats_per_day'], $data['total_protein_per_day'], $data['total_carbs_per_day']] = $this->calculateBMR();
                $data['daily_calories_intake'] = $responseData['daily_calorie_intake'];
            }

            $responseData['bmi_status'] = getBMIHealthStatus($data['bmi']);
            $data['bmi_status'] = $responseData['bmi_status'];
            $responseData['bmi'] = $data['bmi'];
            $heightInCm = (int) round($heightInCm);
            $gender = (auth()->user()->gender == "male" || "other") ? "male" : "female";

            $responseData['idealWeight'] = config("common.ideal_weight.$heightInCm.$gender");
            $data['ideal_weight_should_be'] = $responseData['idealWeight'];
            $responseData['weight'] = $data['weight'];
            $responseData['weight_unit'] = $data['weight_unit'];
        }

        if ($request->has('ideal_weight_goal') && $request->has('weekly_goal')) {

            $data['target_weight'] = $request->ideal_weight_goal;
            $data['target_weight_unit'] = $request->ideal_weight_goal_unit;
            $data['weekly_goals'] = \App\Models\MdDropdown::where(['slug' => 'weekly_goals', 'value' => $request->weekly_goal])->value('id');

            [$responseData['daily_calorie_intake'], $data['total_fats_per_day'], $data['total_protein_per_day'], $data['total_carbs_per_day']] = $this->calculateBMR($request, $data['weekly_goals']);
            $data['daily_calories_intake'] = $responseData['daily_calorie_intake'];

            [$responseData['date_desired_weight_gain_and_loose'], $responseData['weight_difference']] = $this->calculateDateOfDesiredWeight($data);
            $data['target_weight_completion_date'] = now()->parse($responseData['date_desired_weight_gain_and_loose']);
            $data['weight_difference'] = $responseData['weight_difference'];

            [$data['recommended_breakfast_min_calorie_intake'], $data['recommended_breakfast_max_calorie_intake']] = calculateMealCalorieIntake('breakfast', $responseData['daily_calorie_intake']);
            [$data['recommended_lunch_min_calorie_intake'], $data['recommended_lunch_max_calorie_intake']] = calculateMealCalorieIntake('lunch', $responseData['daily_calorie_intake']);
            [$data['recommended_snacks_min_calorie_intake'], $data['recommended_snacks_max_calorie_intake']] = calculateMealCalorieIntake('evening_snack', $responseData['daily_calorie_intake']);
            [$data['recommended_dinner_min_calorie_intake'], $data['recommended_dinner_max_calorie_intake']] = calculateMealCalorieIntake('dinner', $responseData['daily_calorie_intake']);
        }

        if ($request->has('disease')) {

            auth()->user()->diseases()->delete();
            $healthComplaintDiseaseTypeId = config('common.models.health_complaints.disease');

            for ($i = 0; $i < count($request->disease); $i++) {

                $diseaseData[] = [
                    'user_id' => auth()->id(),
                    'health_complaint_id' => $request->disease[$i],
                    'type' => $healthComplaintDiseaseTypeId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            \DB::table('user_health_complaints')->insert($diseaseData);
        }

        auth()->user()->healthStatus()->updateOrCreate(['user_id' => auth()->id()], $data);

        return [
            'status' => 200,
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $responseData,
            'error' => false];
        }

    /**
     * Function: calculateDateOfDesiredWeight
     * Functionality: calculate Desired weight
     *
     * @param array $data
     *
     * @return array
     */
    public function calculateDateOfDesiredWeight($data)
    {
        $userHealthData = auth()->user()->healthStatus;

        if ($data['target_weight'] != null) {

            $weightInKg = convertWeightIntoKG($userHealthData->weight_unit, $userHealthData->weight);
            $goalWeightInKg = convertWeightIntoKG($data['target_weight_unit'], $data['target_weight']);

            return $this->calculateDesiredWeightDate($weightInKg, $goalWeightInKg, $data['weekly_goals']);
        }

        return [null, null];
    }

    public function calculateBMI($request)
    {
        if ($request->height_unit == "ft/in") {

            $height = explode(".", $request->height);

            $heightInInch = ($height[0] * 12) + ((isset($height[1])) ? $height[1] : 0);
            $heightInCm = number_format($heightInInch * 2.54, 2, '.', ',');

        } else {

            $heightInCm = $request->height;
        }

        if ($request->weight_unit == "st") {

            $weightInKg = number_format($request->weight * 6.35, 2, '.', ',');

        } else if ($request->weight_unit == "lbs") {

            $weightInKg = number_format($request->weight * 0.453, 2, '.', ',');

        } else {

            $weightInKg = $request->weight;
        }

        return [$heightInCm, number_format(($weightInKg / $heightInCm / $heightInCm) * 10000, 2, '.', ',')];
    }

    /**
     * Function: calculateBMR
     * Functionality: calculate BMR
     *
     * @param object $request
     * @param string $weeklyGoal
     *
     * @return int
     */
    public function calculateBMR($request = null, $weeklyGoal = null)
    {
        $healthStatusData = auth()->user()->healthStatus;

        $weight = ($weeklyGoal == null) ? $healthStatusData->weight : $healthStatusData->target_weight;
        $weightUnit = ($weeklyGoal == null) ? $healthStatusData->weight_unit : $healthStatusData->target_weight_unit;
        $healthActivityScore = config("common.health_activity.$healthStatusData->health_activity");

        return calculateBMR($healthActivityScore, $healthStatusData->height, $healthStatusData->height_unit, $weight, $weightUnit, $healthStatusData->age, auth()->user()->gender, $healthStatusData->goal_id, $weeklyGoal);
    }
}
