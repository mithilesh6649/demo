<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'brand_name' => $this->brand_name,
            'edmam_food_id' => $this->edmam_food_id,
            'image' => $this->image,
            'slug' => $this->slug,
            'serving_size' => $this->serving_size,
            'serving_type' => $this->serving_type,
            'serving_size_in_gram' => $this->serving_size_in_gram,
            'nutrients' => (new DietNutrientsResource($this)),
        ];
    }
}
