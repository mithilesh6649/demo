<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndividualDietPlanResource extends JsonResource
{
    protected $features;
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
            'diet'=>true,
            'pricing' => [
                'monthly' => $this->resource->monthly_amount,
                'quaterly' => $this->resource->quaterly_amount,
                'annually' => $this->resource->yearly_amount,
            ],
            'description' => $this->resource->description,
            'image' => $this->resource->image,
            'is_free' => $this->resource->is_free,
            'discount' => $this->resource->discount,
            'features' => $this->features,
        ];
    }

    public function featureEnabled($planFeature)
    {
        $this->features = $planFeature;
        return $this;
    }
}
