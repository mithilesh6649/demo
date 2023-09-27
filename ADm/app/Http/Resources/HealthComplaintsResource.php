<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HealthComplaintsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource->types == 4) {

            if (count(auth()->user()->foodAllergies) == 0) {

                $selectedByUser = ($this->resource->name == 'No Allergies') ? true : false;

            } else {

                $selectedByUser = $this->resource->user_selected_options;
            }
        }

        if ($this->resource->types == 5) {

            if (count(auth()->user()->foodPreferences) == 0) {

                $selectedByUser = ($this->resource->name == 'No Food Preferences') ? true : false;

            } else {

                $selectedByUser = $this->resource->user_selected_options;
            }
        }

        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'api_key_slug' => $this->resource->description,
            'selected_by_user' => $selectedByUser,
            'no_pref_allrgy_key' => ($this->resource->name == 'No Allergies' || $this->resource->name == 'No Food Preferences') ? true : false
        ];
    }
}
