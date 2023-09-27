<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\MedicineDoseResource;

class MedicineTrackerResource extends JsonResource
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
            'medicine_tracker_id' => $this->resource->id,
            'medicine_name' => $this->resource->medicine_name,
            'medicine_type_id' => ($this->resource->relationLoaded('medicineType')) ? $this->resource->medicineType->value : null,
            'dose_count' => $this->resource->dose_count,
            'medicine_serving_unit' => ($this->resource->relationLoaded('medicineServingUnit')) ? $this->resource->medicineServingUnit->value : null,
            'scheduler_type' => $this->resource->scheduler_type,
            'specific_days' => ($this->resource->relationLoaded('medicineScheduler')) ? ($this->resource->scheduler_type == 2) ? MedicineSchedulerResource::collection($this->resource->medicineScheduler) : null : null,
            'start_date' => (is_null($this->resource->start_date)) ? null : $this->resource->start_date->format('Y-m-d'),
            'end_date' => (is_null($this->resource->end_date)) ? null : $this->resource->end_date->format('Y-m-d'),
            'schedule' => $this->resource->schedule,
            'notification' => $this->resource->status,
            'doses' => ($this->resource->relationLoaded('doses')) ? MedicineDoseResource::collection($this->resource->doses) : null,
        ];
    }
}
