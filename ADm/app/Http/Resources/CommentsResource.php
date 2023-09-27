<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
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
            'commented_by_image' => (!isset($this->resource->user->healthStatus)) ? null : $this->resource->user->healthStatus->image,
            'commented_by_name' => $this->resource->review_by_name,
            'review_by_email' => $this->resource->review_by_email,
            'commented_date' => $this->resource->updated_at,
            'user_rating' => $this->resource->review,
            'user_comment' => $this->resource->comment,
        ];
    }
}
