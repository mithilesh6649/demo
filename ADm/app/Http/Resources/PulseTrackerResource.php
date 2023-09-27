<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PulseTrackerResource extends JsonResource
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
            'bpm' => $this->resource->bpm,
            'calculated_at' => $this->resource->created_at->formatLocalized('%d %b')
        ];
    }
}
