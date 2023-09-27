<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubDietPlanSubscriptionResource extends JsonResource
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
            'sub_plan_id' => $this->resource->id,
            'title' => $this->resource->title,
            'amount' => $this->resource->amount,
            'price_after_dicount' => $this->resource->amount_after_discount,
            'features' => FeatureResource::collection($this->resource->subPlanFeatures)
        ];
    }
}
