<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LaboratoryResource extends JsonResource
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
            'lab_id' => $this->id,
            'lab_name' => $this->lab_name,
            'lab_description' => $this->description,
            'lab_open_time' => $this->metadata->open_time,
            'lab_close_time' => $this->metadata->close_time,
            'lab_charges' => $this->metadata->charges,
            'lab_address' => $this->metadata->address,
            'lab_city' => $this->metadata->city,
            'lab_state' => $this->metadata->state,
        ];
    }
}
