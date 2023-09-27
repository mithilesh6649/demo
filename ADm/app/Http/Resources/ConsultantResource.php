<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'name' => $this->name,
            'image' => ($this->metadata != null) ? $this->metadata->image : null,
            'description' => ($this->metadata != null) ? $this->metadata->description : null,
            'working_area' => ($this->metadata != null) ? $this->metadata->working_area : null,
            'open_time' => ($this->metadata != null) ? $this->metadata->open_time : null,
            'close_time' => ($this->metadata != null) ? $this->metadata->close_time : null,
            'currency' => ($this->metadata != null) ? $this->metadata->currency : null,
            'charges' => ($this->metadata != null) ? $this->metadata->charges : null,
            'charges_per' => ($this->metadata != null) ? $this->metadata->charges_per : null,
            'average_rating' => ($this->reviews == null) ? [] : $this->reviews->avg_rating,
            'total_review_count' => $this->totalReviewCounts,
            'total_rating_star' => $this->totalRatingStar,
            'comments' => ($this->reviews == null) ? [] : CommentsResource::collection($this->reviews->comments)
        ];
    }

    public function totalRatingStar($totalStar, $totalReviewCounts)
    {
        $this->totalRatingStar = $totalStar;
        $this->totalReviewCounts = $totalReviewCounts;
        return $this;
    }
}
