<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\UserDailyExercise;

class ExerciseResource extends JsonResource
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
            'title' => $this->resource->title,
            'calorie_burnt' => $this->resource->calories_burnt,
            'duration' => $this->resource->duration_in_minutes,
            'is_selected' => in_array($this->resource->id, $this->added_exercise_ids),
        ];
    }
}
