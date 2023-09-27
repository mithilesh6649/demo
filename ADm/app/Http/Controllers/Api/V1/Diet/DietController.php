<?php

namespace App\Http\Controllers\Api\V1\Diet;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\DietService;
use Illuminate\Http\Request;

class DietController extends Controller
{
    protected $dietService;

    public function __construct(DietService $dietService)
    {
        $this->dietService = $dietService;
    }

    /**
     * Function: plans
     * Functionality: This function will fetch the records of diet subscription plan
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function plans()
    {
        $response = $this->dietService->dietPlanListing();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: saveFoodPreferenceAndAllergy
     * Functionality: This will save the user' food preferences and
     * his food allergies
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function saveFoodPreferenceAndAllergy(Request $request)
    {
        $response = $this->dietService->saveFoodPreferenceAndFoodAllergies($request);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: diet
     * Functionality: This will fetch the records of the meals based
     * on the day
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function diet(Request $request)
    {
        $response = $this->dietService->getDiet($request);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: saveFood
     * Functionality: This Fnc will save the food of the user have
     * selected  on a particular date.
     *
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function saveFood(Request $request)
    {
        $response = $this->dietService->saveDietFood();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: getFoodPreferencesAndAllergies
     * Functionality: This Fnc will fetch the listing of allergies
     * and food preferences
     *
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function getFoodPreferencesAndAllergies()
    {
        $response = $this->dietService->listFoodPreferencesAndAllergies();

        return Response::json($response, $response['status']);
    }
}
