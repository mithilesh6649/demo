<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DietPlanSubscriptionResource extends JsonResource
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
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'image' => $this->resource->image,
            'is_free' => $this->resource->is_free,
            'discount' => $this->resource->discount,
        ];
    }
}
