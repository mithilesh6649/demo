<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StepTrackerResource extends JsonResource
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
            'step_count' => $this->resource->step_count,
            'calculated_at' => $this->resource->created_at->formatLocalized('%d %b')
        ];
    }
}
