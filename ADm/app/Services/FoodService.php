<?php

namespace App\Services;

use App\Http\Resources\FoodResource;
use App\Http\Resources\RecipeResource;
use App\Models\UserDiet;
use App\Models\Recipe;

class FoodService {

    /**
     * Function: This will search/list the food which is
     * recommended by the nutritionist
     *
     * @return array
     */
    public function getRecommendedFood(): array
    {
        $recommendedFoods = auth()->user()->listRecommendedFoodByNutrition();

        return ['status' => 200, 'success' => true, 'data' => FoodResource::collection($recommendedFoods), 'error' => false];
    }

    /**
     * Function: getRecipe
     * Functionality: This fnc will fetch the info of recipe
     *
     * @return array
     */
    public function getRecipe($edamamFoodId): array
    {
        $recipeInfo = Recipe::getRecipes($edamamFoodId);

        return ['status' => 200, 'success' => true, 'data' => (is_null($recipeInfo)) ? [] : new RecipeResource($recipeInfo), 'error' => false];
    }

    /**
     * Function: trackFood
     * Functionality: This fnc will track the food
     *
     * @return array
     */
    public function trackFood(): array
    {
        $userDiet = UserDiet::find(request()->food_id);

        $userDiet->is_tracked = (bool) request()->track;
        $userDiet->save();

        return ['status' => 200, 'success' => true, 'message' => 'food successfully tracked', 'error' => false];
    }
}
