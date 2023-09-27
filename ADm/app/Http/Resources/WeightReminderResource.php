<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeightReminderResource extends JsonResource
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
            'selected_type' => ($this->resource->type == "1") ? 'day' : 'date',
            'value' => $this->resource->timepoint,
            'notification' => $this->resource->status
        ];
    }
}
