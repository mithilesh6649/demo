<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'sender_id' => $this->resource->sender_id,
            'is_sender_nutritionist' => $this->resource->is_sender_nutritionist,
            'message_type' => $this->resource->message_type,
            'message' => $this->resource->message,
            'message_at' => $this->resource->created_at->tz('utc')
        ];
    }
}
