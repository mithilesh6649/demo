<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->reviews != null) {

            $comments = $this->reviews->comments->map(function ($item) {

                $comments['commented_by_name'] = $item->review_by_name;
                $comments['commented_by_id'] = $item->id;
                $comments['user_comment'] = $item->comment;
                $comments['user_rating'] = $item->review;
                $comments['commented_date'] = $item->updated_at;

                return $comments;
            });
        }

        return (isset($comments)) ? $comments : [];
    }
}
