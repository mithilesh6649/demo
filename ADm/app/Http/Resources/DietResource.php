<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DietResource extends JsonResource
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
            'id' => $this->resource->food->id,
            'user_diet_table_id' => $this->resource->id,
            'brand_name' => $this->resource->food->brand_name,
            'meal_type' => $this->resource->mealType->slug,
            'edmam_food_id' => $this->resource->food->edmam_food_id,
            'food_image' => $this->resource->food->image,
            'slug' => $this->resource->food->slug,
            'serving_size' => $this->resource->food->serving_size,
            'serving_type' => $this->resource->food->serving_type,
            'serving_size_in_gram' => $this->resource->food->serving_size_in_gram,
            'nutrients' => (new DietNutrientsResource($this->resource->food))->foodQuantity($this->resource->quantity),
        ];
    }
}
