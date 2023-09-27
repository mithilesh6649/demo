<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TraitResource extends JsonResource
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
            'trait_category_id' => $this->resource->id,
            'trait_category_name' => $this->resource->title,
            // 'trait_list' => TraitListResource::collection($this->resource->traitMaps)
        ];
    }
}
