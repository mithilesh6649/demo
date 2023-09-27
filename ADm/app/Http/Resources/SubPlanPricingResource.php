<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubPlanPricingResource extends JsonResource
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
            'sub_plan_pricing_id' => $this->resource->id,
            'title' => $this->resource->subPlan->title,
            'duration' => $this->resource->duration_in_months,
            'amount' => $this->resource->amount,
            'discount_in_percentage' => $this->resource->discount,
            'price_after_dicount' => $this->resource->amount_after_discount,
            'features' => FeatureResource::collection($this->resource->pricingSubPlanFeatures),
        ];
    }
}
