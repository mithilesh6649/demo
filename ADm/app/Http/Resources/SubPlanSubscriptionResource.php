<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubPlanSubscriptionResource extends JsonResource
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
            // 'sub_plan_pricing_id' => $this->resource->id,
            // 'title' => $this->resource->title,
            'pricing' => SubPlanPricingResource::collection($this->resource->pricing),
        ];
    }
}
