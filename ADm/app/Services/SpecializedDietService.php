<?php

namespace App\Services;

use App\Http\Resources\SpecializedDietResource;

class SpecializedDietService
{
    public function getSpecializedDietOpted()
    {
        $responseData = [];
           $allDiets = (request()->all_diets == "true") ? true : false;
           $userSpecializedDiets = auth()->user()->specializedDietPlan($allDiets);
           $allActiveSpecializedDiets = auth()->user()->getSpecializedDietId();
        if (count ($userSpecializedDiets) > 0) {

            foreach ($userSpecializedDiets as $userSpecializedDiet) {
             
                $userSpecializedDiet->slug = \Str::lower(str_replace(' ', '_', preg_replace('/\s+/', ' ', str_replace(['/', '-'], '', $userSpecializedDiet->diet_category_title))));

               $userSpecializedDiet->active = in_array($userSpecializedDiet['diet_id'], $allActiveSpecializedDiets) ? true : false;
            }

            $responseData = $userSpecializedDiets->toArray();
        }

        return ['status' => 200, 'success' => false, 'data' => $responseData, 'error' => false];
    }
}
