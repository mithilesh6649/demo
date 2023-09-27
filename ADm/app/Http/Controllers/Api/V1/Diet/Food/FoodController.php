<?php

namespace App\Http\Controllers\Api\V1\Diet\Food;

use App\Http\Resources\UserFavouriteFoodResource;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Services\FoodService;
use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    protected $foodService;

    public function __construct(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    /**
     * Function: getFood
     * Functionality:
     *
     * @param Dependency \App\Models\Food
     */
    public function getFood(Food $food)
    {
        $response = ['status' => 200, 'success' => true, 'data' => new FoodResource($food), 'error' => false];

        return Response::json($response, $response['status']);
    }

    /**
     * Function: getFavouriteFood
     * Functionality: This Fnc will get the list of fav food of user
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function getFavouriteFood()
    {
        $favFoods = auth()->user()->getFavouriteFoods();
        $response = ['status' => 200, 'success' => true, 'data' => UserFavouriteFoodResource::collection($favFoods), 'error' => false];

        return Response::json($response, $response['status']);
    }

    /**
     * Function: recommendFood
     * Functionality: This Fnc will fetch the list of food
     * which is recommended by the nutritionist based on the
     * meal Type: breakfast_meal, lunch_meal, dinner_meal, snack_meal
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function recommendFood(Request $request)
    {
        $response = $this->foodService->getRecommendedFood();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: checkFoodAddedOrNot
     * Functionality: This will check that the food
     * is already added or not in a particular date
     * and a particular meal type
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function checkFoodAddedOrNot(Request $request)
    {
        $food = auth()->user()->checkIfFoodIsAdded();

        $responseData = [
            'is_added' => (is_null($food)) ? false : true,
            'is_tracked' => (is_null($food)) ? false : (bool) $food->is_tracked
        ];

        $response = ['status' => 200, 'success' => true, 'data' => $responseData, 'error' => false];

        return Response::json($response, $response['status']);
    }

    /**
     * Function: foodRecipe
     * Functionality: This will fetch the records of recipe
     * which is linked with the foods
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function foodRecipe(Request $request)
    {
        $response = $this->foodService->getRecipe($request->edamam_food_id);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: trackFood
     * Functionality: This will change the status of track food
     * based on date, diet plan id and food
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function trackFood(Request $request)
    {
        $response = $this->foodService->trackFood();

        return Response::json($response, $response['status']);
    }
}
