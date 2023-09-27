<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GraphLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $className = get_class($this->resource);
        $reflection = new \ReflectionClass($className);
        $model = $reflection->getShortName();

        if ($model == "UserDietTestLog") {

            return [
                'value' => $this->resource->value,
                'unit' => null,
                'timepoint' => [
                    'year' => $this->resource->log_date->format('Y'),
                    'month' => $this->resource->log_date->format('m'),
                    'date' => $this->resource->log_date->formatLocalized('%d %b')
                ],
            ];

        } else if ($model == "WeightTracker") {

            return [
                'value' => $this->resource->weight,
                'unit' => $this->resource->weight_unit,
                'timepoint' => [
                    'year' => $this->resource->created_at->format('Y'),
                    'month' => $this->resource->created_at->format('m'),
                    'date' => $this->resource->created_at->formatLocalized('%d %b')
                ],
            ];
        } else {

            return [
                'value' => $this->resource->bpm,
                'unit' => null,
                'timepoint' => [
                    'year' => $this->resource->created_at->format('Y'),
                    'month' => $this->resource->created_at->format('m'),
                    'date' => $this->resource->created_at->formatLocalized('%d %b')
                ],
            ];
        }
    }
}
