<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WaterTrackerResource extends JsonResource
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
            'glass_count' => $this->resource->glass_count,
            'unit' => $this->resource->unit,
            'timepoint' => [
                'year' => $this->resource->created_at->format('Y'),
                'month' => $this->resource->created_at->format('m'),
                'date' => $this->resource->created_at->formatLocalized('%d %b')
            ],
        ];
    }
}
