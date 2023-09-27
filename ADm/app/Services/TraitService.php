<?php

namespace App\Services;

use App\Http\Resources\TraitPriceResource;
use App\Http\Resources\TraitListResource;
use App\Http\Resources\TraitResource;
use App\Models\TraitCategory;
use App\Models\TraitsPrice;
use Cache;

class TraitService
{
    public function traitCategoryList()
    {
        $traitsCategoryInfo = Cache::rememberForever('traits_category', function () {
            return TraitCategory::status()->get();
        });

        Cache::forget('trait_price');
        $traitPrice = Cache::rememberForever('trait_price', function () {
            return TraitsPrice::all();
        });

        $responseData = [
            'traits' => TraitResource::collection($traitsCategoryInfo),
            'pricing' => [
                'one' => new TraitPriceResource($traitPrice->where('slug', 'one')->first()),
                'multiple_traits' => new TraitPriceResource($traitPrice->where('slug', '!=', 'all')->where('slug', '!=', 'one')->first()),
                'all' => new TraitPriceResource($traitPrice->where('slug', 'all')->first())
            ],
        ];

        return ['status' => 200, 'success' => true, 'data' => $responseData, 'error' => false];
    }

    public function traitList()
    {
        $traitLisInfo = new TraitCategory;
        return ['status' => 200, 'success' => true, 'data' => TraitListResource::collection($traitLisInfo->traits()), 'error' => false];
    }
}
