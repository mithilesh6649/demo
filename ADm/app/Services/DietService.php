<?php

namespace App\Services;

use App\Http\Resources\DietPlanSubscriptionResource;
use App\Http\Resources\HealthComplaintsResource;
use App\Http\Resources\DailyExerciseResource;
use App\Http\Resources\DietResource;
use App\Models\DietPlanSubscription;
use App\Models\UserExercise;
use App\Models\UserDailyDiet;
use App\Models\UserDiet;
use App\Models\Food;

class DietService {

    /**
     * Function: dietPlanListing
     * Functionality: This function will get the listing of the
     * diet subscription
     *
     * @return array
     */
    public function dietPlanListing():array
    {
        $dietPlans = auth()->user()->purchasedDietPlan;

        return ['status' => 200, 'success' => true, 'data' => ['plans' => DietPlanSubscriptionResource::collection($dietPlans), 'health_status_data' => auth()->user()->ifHealthDataExists()], 'error' => false] ;
    }

    /**
     * Function: dietPlanListing
     * Functionality: This function will get the listing of the
     * diet subscription
     *
     * @param object $request
     *
     * @return array
     */
    public function saveFoodPreferenceAndFoodAllergies($request): array
    {
        try {

            if (!empty($request->food_preferences)) {

                auth()->user()->foodPreferences()->delete();

                for ($i = 0; $i < count($request->food_preferences); $i++) {

                    auth()->user()->foodPreferences()->create(['user_id' => auth()->id(), 'food_preference_id' => $request->food_preferences[$i]]);
                }
            }

            if (!empty($request->allergies)) {

                auth()->user()->foodAllergies()->delete();

                for ($i = 0; $i < count($request->allergies); $i++) {

                    auth()->user()->foodAllergies()->create(['user_id' => auth()->id(), 'health_complaint_id' => $request->allergies[$i], 'type' => 4]);
                }
            }

            return ['status' => 200, 'success' => true, 'message' => 'Preferences and allergies added', 'error' => false] ;

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: getDiet
     * Functionality: This function will get the records of the meals
     * based on the day. If there is no date in request then fetch
     * the current day meals data
     *
     * @param object $request
     *
     * @return array
     */
    public function getDiet($request)
    {
        $date = $request->date ? now()->parse($request->date)->format('Y-m-d') : today();
        $dietId = request()->diet_id ?? null;
        $diets = auth()->user()->currentDayDiet($date, $request->diet_plan_id, $dietId)->with(['diets.food', 'diets.mealType'])->first();
        [$breakfastDiet, $lunchDiet, $snacksDiet, $dinnerDiet] = $this->getAllMealDiets($diets);

        $responseData['meals']['breakfast'] = $breakfastDiet;
        $responseData['meals']['lunch'] = $lunchDiet;
        $responseData['meals']['snacks'] = $snacksDiet;
        $responseData['meals']['dinner'] = $dinnerDiet;
        $responseData['calories'] = $this->calories($diets);
        $responseData['nutrients'] = $this->calculateNutrientsPerDay($diets);
        $responseData['exercise'] = $this->currentDayExercises($date);
        $responseData['selected_preferences'] = auth()->user()->selectedFoodAllergiesAndFoodPreferences()['selected_preferences_keys'];
        $responseData['selected_preferences_name'] = auth()->user()->selectedFoodAllergiesAndFoodPreferences()['selected_preferences_name'];
        $responseData['important_recommendations'] = optional($diets)->imp_recommendations;
        return [ 'status' => 200, 'success' => true, 'data' => $responseData, 'error' => false];
    }

    /**
     * Function: currentDayExercises
     * Functionality: This function  will calculate nutrients
     * based on per day
     *
     * @param string $date
     *
     * @return array
     */
    private function currentDayExercises($date)
    {
        $exercises = auth()->user()->currentDayExercise($date)->with(['exercises.exercise'])->first();

        return [
            'recommended_exercise_per_day' => '30 mins',
            'exercises' => ($exercises == null) ? [] : DailyExerciseResource::collection(UserExercise::where('user_daily_exercise_id', $exercises->id)->with('exercise')->get())
        ];
    }

    /**
     * Function: calculateNutrientsPerDay
     * Functionality: This function  will calculate nutrients
     * based on per day
     *
     * @param collection $diets
     *
     * @return array
     */
    private function calculateNutrientsPerDay($diets)
    {
        $healthStatus = auth()->user()->healthStatus;

        $nutrientsData['recommended_nutrients'] = [
            'fat' => $healthStatus->total_fats_per_day ?? 00,
            'carbs' => $healthStatus->total_carbs_per_day ?? 00,
            'protein' => $healthStatus->total_protein_per_day ?? 00,
        ];

        $nutrientsData['intake_nutrients'] = [
            'fat' => $diets->total_fat_intake ?? 0,
            'carbs' => $diets->total_carbs_intake ?? 0,
            'protein' => $diets->total_protein_intake ?? 0,
        ];

        return $nutrientsData;
    }

    /**
     * Function: getAllMealDiets
     * Functionality: This function  will bind the all meals
     *
     * @param collection $diets
     *
     * @return array
     */
    private function getAllMealDiets($diets):array
    {
        if ($diets == null) {

            return [[], [], [], []];
        }
        $mealsIds = \App\Models\MdDropdown::select('id', 'slug')->where('module', 'meals')->get();

        return [
            DietResource::collection($diets->diets->where('meal_type_id', $mealsIds->where('slug', config('common.meals_slug_name.breakfast'))->first()->id)),
            DietResource::collection($diets->diets->where('meal_type_id', $mealsIds->where('slug', config('common.meals_slug_name.lunch'))->first()->id)),
            DietResource::collection($diets->diets->where('meal_type_id', $mealsIds->where('slug', config('common.meals_slug_name.snacks'))->first()->id)),
            DietResource::collection($diets->diets->where('meal_type_id', $mealsIds->where('slug', config('common.meals_slug_name.dinner'))->first()->id)),
        ];
    }

    /**
     * Function: calories
     * Functionality: This function  will bind the calories which
     * is recommended and which is taken by the user
     *
     * @param collection $diets
     *
     * @return array
     */
    private function calories($diets):array
    {
        $healthStatus = auth()->user()->healthStatus;
        $recommendedCal = ($diets == null) ? auth()->user()->getRecommendedCalorieWithExercise($healthStatus) : $diets->total_calorie_intake_perday;

        return [
            'recommended_calorie_per_day' => $recommendedCal ?? 00,
            'intake_calorie_per_day' => $diets->total_calorie_intake ?? 00,
            'recommended_calorie_per_meal' => [
                'recommended_breakfast_calories' => [
                    'min' => $healthStatus->recommended_breakfast_min_calorie_intake ?? 0,
                    'max' => $healthStatus->recommended_breakfast_max_calorie_intake ?? 0
                ],
                'recommended_lunch_calories' => [
                    'min' => $healthStatus->recommended_lunch_min_calorie_intake ?? 0,
                    'max' => $healthStatus->recommended_lunch_max_calorie_intake ?? 0
                ],
                'recommended_snacks_calories' => [
                    'min' => $healthStatus->recommended_snacks_min_calorie_intake ?? 0,
                    'max' => $healthStatus->recommended_snacks_max_calorie_intake ?? 0
                ],
                'recommended_dinner_calories' => [
                    'min' => $healthStatus->recommended_dinner_min_calorie_intake ?? 0,
                    'max' => $healthStatus->recommended_dinner_max_calorie_intake ?? 0
                ],
            ],
            'intake_calories_per_meal' => [
                'intake_breakfast_calorie' => $diets->total_breakfast_calorie_intake ?? 0,
                'intake_lunch_calorie' => $diets->total_lunch_calorie_intake ?? 0,
                'intake_snack_calorie' => $diets->total_snack_calorie_intake ?? 0,
                'intake_dinner_calorie' => $diets->total_dinner_calorie_intake ?? 0,
            ]
        ];
    }

    /**
     * Function: saveDietFood
     * Functionality: This Fnc will store the food
     *
     * @return array
     */
    public function saveDietFood():array
    {
        try {

            $food = new Food;
            $foodInfo = $food->saveFood($this->extractFoodData());
            $date = now()->parse(request()->date)->format('Y-m-d');

            $userDailyDiet = UserDailyDiet::firstOrCreate(['user_id' => auth()->id(), 'meal_date' => $date, 'diet_plan_id' => request()->diet_plan_id, 'diet_id' => request()->diet_id]);

            $userDiet = new UserDiet;
            $userDiet->saveUserDiet($foodInfo->id, $userDailyDiet->id);

            return ['status' => 200, 'success' => true, 'message' => 'Food is successfully added to your meal', 'error' => false];

        } catch (\Exception $e) {
            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    private function extractFoodData()
    {
        $foodNutrientsData = [];

        if (request()->totalNutrients) {

            foreach (request()->totalNutrients as $nutrientKey => $nutrients) {

                if (config('common.models.foods.nutrients.'.$nutrientKey) != null) {

                    $foodNutrientsData[config('common.models.foods.nutrients.'.$nutrientKey)] = $nutrients['quantity'];
                    $foodNutrientsData[config('common.models.foods.nutrients.'.$nutrientKey).'_unit'] = $nutrients['unit'];
                }
            }

            //add other details in array
            $foodNutrientsData['brand_description'] = request()->brand_description;
            $foodNutrientsData['serving_size_in_gram'] = request()->serving_size_in_gram;
            $foodNutrientsData['serving_container'] = request()->serving_container;
        }

        return $foodNutrientsData;
    }

    /**
     * Function: listFoodPreferencesAndAllergies
     * Functionality: This fnc will fetch the user's food prefenrences
     * and food allergies.
     *
     * @return array
     */
    public function listFoodPreferencesAndAllergies():array
    {
        $combinedData = \App\Models\HealthComplaint::getFoodPreferencesAndFoodAllergies();

        $responseData = [
            'food_allergies' => HealthComplaintsResource::collection($combinedData->where('types', 4)),
            'food_preferences' => HealthComplaintsResource::collection($combinedData->where('types', 5))
        ];

        return ['status' => 200, 'success' => true, 'data' => $responseData, 'error' => false];

    }
}
