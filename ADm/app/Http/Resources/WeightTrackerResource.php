<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeightTrackerResource extends JsonResource
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
            'weight' => $this->resource->weight,
            'weight_unit' => $this->resource->weight_unit,
            'timepoint' => [
                'year' => $this->resource->created_at->format('Y'),
                'month' => $this->resource->created_at->format('m'),
                'date' => $this->resource->created_at->formatLocalized('%d %b')
            ],
        ];
    }
}
