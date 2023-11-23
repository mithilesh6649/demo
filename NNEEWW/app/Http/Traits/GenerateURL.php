<?php

namespace App\Http\Traits;

trait GenerateURL {

    public function generateEdamamURL($urlType)
    {
        $url;

        switch ($urlType) {

            case 'nutrients':
                $url = config('common.edamam.base_url').config('common.edamam.food_nutrients_endpoint');
                $url .= "app_id=".config('common.edamam.food_api_app_id');
                $url .= "&app_key=".config('common.edamam.food_app_key');
                break;
        }

        return $url;
    }
}
