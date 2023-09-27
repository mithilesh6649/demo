<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
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
            // 'title' => $this->resource->id,
            // 'description' => $this->resource->description,
            'image' => $this->resource->image,
            'time_in_minutes' => $this->resource->time,
            'calorie' => $this->resource->kilocalorie,
            'serving' => $this->resource->serving,
            'html' => $this->resource->recipe_info_html,
            // 'ingredients' => $this->resource->ingredients,
            // 'instructions' => $this->resource->instructions,
        ];
    }
}
