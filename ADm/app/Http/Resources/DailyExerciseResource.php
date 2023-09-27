<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DailyExerciseResource extends JsonResource
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
            'exercise_id' => $this->resource->id,
            'actual_exercise_id' => $this->resource->exercise_id,
            'title' => $this->exercise->title,
            'calorie_burnt' => round($this->exercise->calories_burnt * ($this->resource->duration / 60), 3),
            'duration' => $this->resource->duration,
        ];
    }
}
